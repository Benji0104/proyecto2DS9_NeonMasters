/*
// sw.js 
const BASE = '/proyecto2/Pantallas';
const CACHE = 'cache-v1';

self.addEventListener('activate', evt =>
  evt.waitUntil(self.clients.claim())
);

self.addEventListener('fetch', evt => {
  const req = evt.request;
  const url = new URL(req.url);

  // Solo navegaciones dentro de BASE
  if (req.method === 'GET'
      && req.mode === 'navigate'
      && url.origin === location.origin
      && url.pathname.startsWith(BASE)) {

    // Obtén la parte relativa a BASE
    let rel = url.pathname.slice(BASE.length);  // e.g. "/index" or "/aboutUs"
    if (rel === '' || rel === '/') rel = '/index';

    // Si no hay punto en rel, asumimos que quieren un .php
    if (!rel.includes('.')) {
      const phpPath = `${BASE}${rel}.php`;  // '/proyecto2/Pantallas/index.php'
      evt.respondWith(
        caches.match(phpPath).then(cacheRes => {
          if (cacheRes) return cacheRes;
          return fetch(phpPath).then(netRes => {
            // Cachea solo respuestas 200 válidas
            if (netRes && netRes.status === 200 && netRes.type === 'basic') {
              const copy = netRes.clone();
              caches.open(CACHE).then(c => c.put(phpPath, copy));
            }
            return netRes;
          });
        }).catch(() =>
          // Fallback: tu index.php
          fetch(`${BASE}/index.php`)
        )
      );
      return;
    }
  }

  // En todos los demás casos (assets, peticiones AJAX, .php explícito...), passthrough
  evt.respondWith(// sw.js 
    const BASE = '/proyecto2/Pantallas';
    const CACHE = 'cache-v1';
    
    self.addEventListener('activate', evt =>
      evt.waitUntil(self.clients.claim())
    );
    
    self.addEventListener('fetch', evt => {
      const req = evt.request;
      const url = new URL(req.url);
    
      // Solo navegaciones dentro de BASE
      if (req.method === 'GET'
          && req.mode === 'navigate'
          && url.origin === location.origin
          && url.pathname.startsWith(BASE)) {
    
        // Obtén la parte relativa a BASE
        let rel = url.pathname.slice(BASE.length);  // e.g. "/index" or "/aboutUs"
        if (rel === '' || rel === '/') rel = '/index';
    
        // Si no hay punto en rel, asumimos que quieren un .php
        if (!rel.includes('.')) {
          const phpPath = `${BASE}${rel}.php`;  // '/proyecto2/Pantallas/index.php'
          evt.respondWith(
            caches.match(phpPath).then(cacheRes => {
              if (cacheRes) return cacheRes;
              return fetch(phpPath).then(netRes => {
                // Cachea solo respuestas 200 válidas
                if (netRes && netRes.status === 200 && netRes.type === 'basic') {
                  const copy = netRes.clone();
                  caches.open(CACHE).then(c => c.put(phpPath, copy));
                }
                return netRes;
              });// sw.js 
              const BASE = '/proyecto2/Pantallas';
              const CACHE = 'cache-v1';
              
              self.addEventListener('activate', evt =>
                evt.waitUntil(self.clients.claim())
              );
              
              self.addEventListener('fetch', evt => {
                const req = evt.request;
                const url = new URL(req.url);
              
                // Solo navegaciones dentro de BASE
                if (req.method === 'GET'
                    && req.mode === 'navigate'
                    && url.origin === location.origin
                    && url.pathname.startsWith(BASE)) {
              
                  // Obtén la parte relativa a BASE
                  let rel = url.pathname.slice(BASE.length);  // e.g. "/index" or "/aboutUs"
                  if (rel === '' || rel === '/') rel = '/index';
              
                  // Si no hay punto en rel, asumimos que quieren un .php
                  if (!rel.includes('.')) {
                    const phpPath = `${BASE}${rel}.php`;  // '/proyecto2/Pantallas/index.php'
                    evt.respondWith(
                      caches.match(phpPath).then(cacheRes => {
                        if (cacheRes) return cacheRes;
                        return fetch(phpPath).then(netRes => {
                          // Cachea solo respuestas 200 válidas
                          if (netRes && netRes.status === 200 && netRes.type === 'basic') {
                            const copy = netRes.clone();
                            caches.open(CACHE).then(c => c.put(phpPath, copy));
                          }
                          return netRes;
              // sw.js 
const BASE = '/proyecto2/Pantallas';
const CACHE = 'cache-v1';

self.addEventListener('activate', evt =>
  evt.waitUntil(self.clients.claim())
);

self.addEventListener('fetch', evt => {
  const req = evt.request;
  const url = new URL(req.url);

  // Solo navegaciones dentro de BASE
  if (req.method === 'GET'
      && req.mode === 'navigate'
      && url.origin === location.origin
      && url.pathname.startsWith(BASE)) {

    // Obtén la parte relativa a BASE
    let rel = url.pathname.slice(BASE.length);  // e.g. "/index" or "/aboutUs"
    if (rel === '' || rel === '/') rel = '/index';

    // Si no hay punto en rel, asumimos que quieren un .php
    if (!rel.includes('.')) {
      const phpPath = `${BASE}${rel}.php`;  // '/proyecto2/Pantallas/index.php'
      evt.respondWith(
        caches.match(phpPath).then(cacheRes => {
          if (cacheRes) return cacheRes;
          return fetch(phpPath).then(netRes => {
            // Cachea solo respuestas 200 válidas
            if (netRes && netRes.status === 200 && netRes.type === 'basic') {
              const copy = netRes.clone();
              caches.open(CACHE).then(c => c.put(phpPath, copy));
            }
            return netRes;
          });
        }).catch(() =>
          // Fallback: tu index.php
          fetch(`${BASE}/index.php`)
        )
      );
      return;
    }
  }

  // En todos los demás casos (assets, peticiones AJAX, .php explícito...), passthrough
  evt.respondWith(fetch(req));
});
          });
                      }).catch(() =>
                        // Fallback: tu index.php
                        fetch(`${BASE}/index.php`)
                      )
                    );
                    return;
                  }
                }
              
                // En todos los demás casos (assets, peticiones AJAX, .php explícito...), passthrough
                evt.respondWith(fetch(req));
              });
              
            }).catch(() =>
              // Fallback: tu index.php
              fetch(`${BASE}/index.php`)
            )
          );
          return;
        }
      }
    
      // En todos los demás casos (assets, peticiones AJAX, .php explícito...), passthrough
      evt.respondWith(fetch(req));
    });
    fetch(req));
});
*/