self.addEventListener("install", e => {
    console.log("Service worker installing...");
    // Cache resources for static use
    e.waitUntil(
        caches.open("static").then(cache => {
            return cache.addAll([
                "./",
                "./css/index.css",
                "./images/logo.png",
                "./index.php",
                "./splash.html",
                "./recherche.php",
                "./mon-compte.php",
                "./accueil.php",
                "./enregistrement.html",
                "./donation.php",
                "./don-souscription.php",
                "./connexion.html",
                "./statistics.php",
                "./association.php",
                "./scanner.php",
                "./css/splash.css",
                "./css/rechercher.css",
                "./css/mon-compte.css",
                "./css/home.css",
                "./css/enregistrement.css",
                "./css/donation.css",
                "./css/statistics.css",
                "./css/don-souscription.css",
                "./css/connexion.css",
                "./css/association.css",
                "./js/association.js",
                "./js/dataAssociation.js",
                "./js/index.js",
                "./js/recherche.js",
                "./js/statistics.js"
            ]);
        }).catch((error) => {
            console.error('Cache opening failed during installation:', error);
        })
    );
});

// Once the install event is complete, activate the service worker
self.addEventListener("activate", e => {
    console.log("Service worker activated.");
    e.waitUntil(
        // This step ensures that the service worker doesn't handle requests until the cache is ready
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    // Optionally, delete outdated caches here
                    if (cacheName !== 'static') {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Intercepting the fetch event
self.addEventListener("fetch", e => {
    e.respondWith(
        caches.match(e.request).then(response => {
            // Return cached response or fetch from network
            return response || fetch(e.request).then(networkResponse => {
                // Optionally cache the new response for later use
                return caches.open('static').then(cache => {
                    cache.put(e.request, networkResponse.clone());
                    return networkResponse;
                });
            });
        }).catch(error => {
            console.error('Fetch failed:', error);
        })
    );
});
