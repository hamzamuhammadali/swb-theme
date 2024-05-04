var cacheName = 'app';
var filesToCache = [
  'index.html',
  'style.css',
  'photos.js',
  'logo.svg',
  'camera.svg',
  'signature.js',
  'fonts/vEFR2_JTCgwQ5ejvG1EmBlprZ0g.woff2',
  'fonts/vEFR2_JTCgwQ5ejvG14mBlprZ0gk0w.woff2',
  'fonts/vEFR2_JTCgwQ5ejvG18mBlprZ0gk0w.woff2'
];

/* Start the service worker and cache all of the app's content */
self.addEventListener('install', function (e) {
  e.waitUntil(
    caches.open(cacheName).then(function (cache) {
      return cache.addAll(filesToCache);
    })
  );
});

/* Serve cached content when offline */
addEventListener('fetch', function (event) {
  event.respondWith(
    caches.match(event.request)
      .then(function (response) {
        if (response) {
          return response;     // if valid response is found in cache return it
        } else {
          return fetch(event.request)     //fetch from internet
            .then(function (res) {
              return caches.open(cacheName)
                .then(function (cache) {
                  cache.put(event.request.url, res.clone());    //save the response for future
                  return res;   // return the fetched data
                })
            })
            .catch(function (err) {       // fallback mechanism
              return caches.open(cacheName)
                .then(function (cache) {
                  return cache.match('index.html');
                });
            });
        }
      })
  );
});


