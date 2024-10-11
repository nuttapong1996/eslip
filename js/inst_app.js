



let deferredPrompt;

window.addEventListener('beforeinstallprompt', (event) => {
  event.preventDefault();
  deferredPrompt = event;
  const installBtn = document.getElementById('installBtn');
  installBtn.style.display = 'block';

  installBtn.addEventListener('click', () => {
    installBtn.style.display = 'none';
    deferredPrompt.prompt();

    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('User accepted the install prompt');
      } else {
        console.log('User dismissed the install prompt');
      }
      deferredPrompt = null;
    });
  });
});


function isIOS() {
  return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
}

function isInStandaloneMode() {
  return (window.matchMedia('(display-mode: standalone)').matches) || (window.navigator.standalone);
}

document.addEventListener('DOMContentLoaded', function() {
  if (isIOS() && !isInStandaloneMode()) {
      // แสดงขั้นตอนการติดตั้งบน ios
      document.getElementById('iosInstallBanner').style.display = 'block';
  }
});
