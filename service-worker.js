if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/service-worker.js')
      .then(registration => {
        console.log('Service Worker registered with scope:', registration.scope);
      })
      .catch(error => {
        console.log('Service Worker registration failed:', error);
      });
  });
}

const CACHE_NAME = 'sqmm-e-slip-cache';
const urlsToCache = [
  '/',
  '/login.php',
  '/index.php',
  '/css/bootstrap.min.css',
  '/css/*.css',
  '/js/*.js',
  '/assets/favicon.ico',
  '/assets/images/icon.png',
  '/assets/images/icon-152x152.png',
  '/assets/images/icon-167x167.png',
  '/assets/images/icon-180x180.png',
  '/assets/images/icon-192x192.png',
  '/assets/images/icon-512x512.png',
  '/assets/images/logo.png',
  './assets/images/logo_white.png'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        return response || fetch(event.request);
      })
  );
});

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



// self.addEventListener('install', function(event) {
    // event.waitUntil(
      // caches.open('e-slip-cache').then(function(cache) {
        // return cache.addAll([
          // './manifest.json',
          // './login.php',
          // './index.php',
          // './css/bootstrap.min.css',
          // './css/*.css',
          // './js/*.js',
          // './assets/favicon.ico',
          // './assets/images/icon.jpg',
          // './assets/images/icon-152x152.jpg',
          // './assets/images/icon-167x167.jpg',
          // './assets/images/icon-180x180.jpg',
          // './assets/images/icon-192x192.jpg',
          // './assets/images/icon-512x512.jpg',
          // './assets/images/logo.png',
          // './assets/images/logo_white.png'
        // ]);
      // })
    // );
  // });