self.addEventListener("install", e => {
    console.log("install");
    // cache resources for static use
    e.waitUntil(
        caches.open("static").then(cache => {
            return cache.addAll(["./", "./css/index.css", "./images/logo.png"])
        })
    )
});

self.addEventListener("fetch", e => {
    e.respondWith(
        cache.match(e.request).then(response => {
            return response || fetch(e.request);
        })
    );
});