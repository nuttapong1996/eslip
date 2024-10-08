self.addEventListener('install', function(event) {
    event.waitUntil(
      caches.open('e-slip-cache').then(function(cache) {
        return cache.addAll([
          './manifest.json',
          './login.php',
          './index.php',
          './css/bootstrap.min.css',
          './css/*.css',
          './js/*.js',
          './assets/favicon.ico',
          './assets/images/icon.jpg',
          './assets/images/icon-152x152.jpg',
          './assets/images/icon-167x167.jpg',
          './assets/images/icon-180x180.jpg',
          './assets/images/icon-192x192.jpg',
          './assets/images/icon-512x512.jpg',
          './assets/images/logo.png',
          './assets/images/logo_white.png'
        ]);
      })
    );
  });

  self.addEventListener('fetch', function(event) {
    event.respondWith(
      caches.match(event.request).then(function(response) {
        return response || fetch(event.request);
      })
    );
  });
  