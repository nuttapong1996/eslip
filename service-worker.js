self.addEventListener('install', function(event) {
    event.waitUntil(
      caches.open('my-cache').then(function(cache) {
        return cache.addAll([
          'index.php',
          'home.php',
          'css/bootstrap.min.css',
          'css/*.css',
          'js/*.js',
          'assets/images/icon.png',
          'assets/images/icon-192x192.png',
          'assets/images/icon-512x512.png',
          'assets/images/logo.png',
          'assets/images/logo_white.png'

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
  