self.addEventListener("install", e => {
    console.log("install");
    // cache resources for static use
    e.waitUntil(
        caches.open("static").then(cache => {
            return cache.addAll(["./", 
                "./css/index.css", 
                "./images/logo.png",
                "./index.html",
                "./splash.html",
                "./recherche.html",
                "./mon-compte.html",
                "./home.html",
                "./enregistrement.html",
                "./donation.html",
                "./don-souscription.html",
                "./connexion.html",
                "./association.html",
                "./css/splash.css",
                "./css/rechercher.css",
                "./css/mon-compte.css",
                "./css/home.css",
                "./css/enregistrement.css",
                "./css/donation.css",
                "./css/don-souscription.css",
                "./css/connexion.css",
                "./css/association.css",
                "./js/association.js",
                "./js/dataAssociation.js",
                "./js/index/js",
                "./js/recherche.js"])
        })
    )
});

self.addEventListener("fetch", e => {
    e.respondWith(
        caches.match(e.request).then(response => {
            return response || fetch(e.request);
        })
    );
});