const CACHE_NAME = "Elip-cache";
const OFFLINE_URL = 'offline.php';

// ไฟล์ที่ต้องการ cache
const contentToCache = [
    '/',
    'login.php',
    'index.php',
    'offline.php',
    'assets/images/offline.png',
    'components/head.php',
];

// ติดตั้ง Service Worker และทำการ cache ไฟล์
self.addEventListener('install', event => {
	event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
		contentToCache.forEach(content => {
			cache.add(content).catch(_ => console.error(`Error while caching "${content}"`))
		});
	}));
  console.log('Service Worker installed');
});


// จัดการ Fetch request
self.addEventListener('fetch', event => {
  if (event.request.mode === 'navigate') {
    event.respondWith(
      fetch(event.request).catch(() => {
          return caches.open(CACHE_NAME).then(cache => {
          return cache.match(OFFLINE_URL);
        });
      })
    );
  }
});

// ลบ Cache เก่าที่ไม่ได้ใช้
self.addEventListener('activate', event => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (!cacheWhitelist.includes(cacheName)) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
