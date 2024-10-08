<!-- Js Library -->
<script src="./js/jquery-3.7.1.min.js"></script> 
<script src="./js/bootstrap.bundle.min.js"></script> 
<script src="./js/popper.min.js"></script> 
<script src="./js/simple-datatables.min.js"></script>
<script src="./js/sweetalert2@11.js"></script>
<script src="./js/fontawezome-6.3.0.js"></script>

<!-- Ajax Script -->
<script src="./js/scripts.js"></script>
<script src="./js/period_select.js"></script>
<script src="./js/emp_edit.js"></script>
<script src="./js/emp_regis.js"></script>
<script src="./js/emp_pass_edit.js"></script>

<!-- PWA  -->
<link rel="manifest" href="manifest.json">
<scrip src="service-worker.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/style.css">
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/fonts.css">

<!-- favicon -->
<link rel="icon" type="image/x-icon" href="./assets/favicon.ico">

<!-- iOS icon -->
<link rel="apple-touch-icon" href="./assets/images/icon.jpg">
<link rel="apple-touch-icon" sizes="152x152" href="./assets/images/icon-152x152.jpg">
<link rel="apple-touch-icon" sizes="180x180" href="./assets/images/icon-180x180.jpg">
<link rel="apple-touch-icon" sizes="167x167" href="./assets/images/icon-167x167.jpg">

<!-- iOS splash -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<link href="./assets/images/splash-2048.jpg" sizes="2048x2732" rel="apple-touch-startup-image" />
<link href="./assets/images/splash-1668.jpg" sizes="1668x2224" rel="apple-touch-startup-image" />
<link href="./assets/images/splash-1536.jpg" sizes="1536x2048" rel="apple-touch-startup-image" />
<link href="./assets/images/splash-1125.jpg" sizes="1125x2436" rel="apple-touch-startup-image" />
<link href="./assets/images/splash-1242.jpg" sizes="1242x2208" rel="apple-touch-startup-image" />
<link href="./assets/images/splash-750.jpg" sizes="750x1334" rel="apple-touch-startup-image" />
<link href="./assets/images/splash-640.jpg" sizes="640x1136" rel="apple-touch-startup-image" />


<script>
    // Detects if device is on iOS 
const isIos = () => {
  const userAgent = window.navigator.userAgent.toLowerCase();
  return /iphone|ipad|ipod/.test( userAgent );
}
// Detects if device is in standalone mode
const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);

// Checks if should display install popup notification:
if (isIos() && !isInStandaloneMode()) {
  this.setState({ showInstallMessage: true });
}

</script>
