// ============================================================
// sw.js — service worker
// ============================================================
// Caches the app shell (HTML/CSS/JS/icons) so the app opens instantly
// and the UI itself works offline. Deliberately does NOT cache any
// API response (login, mydata, roster, directory) — member data
// should never be served stale from a cache; every API call always
// goes to the network. Bump CACHE_VERSION on every deploy so old
// cached shells get evicted correctly instead of a member getting
// stuck on a stale version indefinitely.
// ============================================================

const CACHE_VERSION = 'bpa-shell-v16';
const SHELL_FILES = [
  './',
  './index.html',
  './style.css',
  './app.js',
  './manifest.json',
  './icon-192.png',
  './icon-512.png',
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_VERSION).then((cache) => cache.addAll(SHELL_FILES))
  );
  self.skipWaiting();
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(
        keys.filter((key) => key !== CACHE_VERSION).map((key) => caches.delete(key))
      )
    )
  );
  self.clients.claim();
});

self.addEventListener('fetch', (event) => {
  const url = new URL(event.request.url);

  // Never intercept API calls — always hit the network directly, so
  // member data is never served from a stale cache.
  if (url.pathname.includes('/welcome-api/')) {
    return;
  }

  // App shell files: cache-first, so the app opens instantly even
  // offline, falling back to network for anything not yet cached.
  event.respondWith(
    caches.match(event.request).then((cached) => cached || fetch(event.request))
  );
});
