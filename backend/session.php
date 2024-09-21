<?php
   session_start();
// Set timeout duration in seconds
$timeout_duration = 300; // 5 minutes

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration)) {
    session_unset();
    session_destroy();
} 
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp
?>

<script>
let sessionDuration = 300; // Total session time in seconds (5 minutes)
let timeoutWarning = 300; // 5 minutes in seconds
let isSessionActive = true;

    function updateCountdown() {
        const minutes = Math.floor(timeoutWarning / 60);
        const seconds = timeoutWarning % 60;

        document.getElementById('gcMaxLifetime').textContent = `เซสชั่นจะหมดอายุ : ${minutes}นาที ${seconds}วินาที`;

        if (timeoutWarning <= 0) {
            clearInterval(countdownInterval);
            window.location.href = "logout";
        }
        timeoutWarning--;
    }

    function keepSessionAlive() {
        fetch('keep-alive.php') // Server-side script to keep session active
            .then(response => {
                if (!response.ok) {
                    isSessionActive = false;
                    window.location.href = "logout";
                }
            })
            .catch(error => {
                console.error("Error keeping session alive:", error);
            });

    }
    // Start the countdown
    const countdownInterval = setInterval(updateCountdown, 1000); // Update every second
    setInterval(() => {
        if (isSessionActive) {
            keepSessionAlive(); // Keep session alive every minute
        }
    }, 60000);// Keep session alive every minute


</script>
