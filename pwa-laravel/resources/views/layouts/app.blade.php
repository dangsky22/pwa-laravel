<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <meta name="theme-color" content="#0ea5e9">
    <link rel="manifest" href="/manifest.webmanifest">
    <link rel="icon" href="/favicon.ico" sizes="any">

    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-white text-slate-900 dark:bg-slate-950 dark:text-slate-100">
<div class="min-h-screen grid place-items-center p-6">
    <div class="w-full max-w-3xl rounded-xl border border-slate-200/60 dark:border-slate-800 bg-white/80 dark:bg-slate-900/60 backdrop-blur p-8 shadow-sm">
        @yield('content')
    </div>
</div>

<!-- Install bottom popup -->
<div id="install-card" class="fixed inset-x-0 bottom-0 z-50 px-4 pb-6 hidden">
    <div class="mx-auto max-w-md rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xl p-4">
        <div class="flex items-start gap-3">
            <div class="shrink-0 h-10 w-10 rounded-lg bg-sky-500 text-white grid place-items-center font-semibold">PWA</div>
            <div class="flex-1">
                <h2 class="text-base font-semibold">Install this app</h2>
                <p class="text-sm text-slate-600 dark:text-slate-400">Add it to your home screen for a faster, full-screen experience.</p>
                <div class="mt-3 flex gap-2">
                    <button id="install-confirm" class="inline-flex items-center gap-2 rounded-lg bg-sky-600 hover:bg-sky-700 text-white px-3 py-2 text-sm font-medium">Install</button>
                    <button id="install-dismiss" class="inline-flex items-center gap-2 rounded-lg border border-slate-300 dark:border-slate-700 px-3 py-2 text-sm">Maybe later</button>
                </div>
            </div>
        </div>
    </div>
    <!-- small helper text -->
    <div class="mx-auto max-w-md mt-2 text-center text-xs text-slate-500 dark:text-slate-400">Tip: On iOS, use Share → Add to Home Screen</div>
    </div>

<script>
// Register Service Worker
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/serviceworker.js').catch(function(err) {
            console.warn('ServiceWorker registration failed:', err);
        });
    });
}

// Handle PWA install prompt with bottom popup
let deferredPrompt;
const card = document.getElementById('install-card');
const confirmBtn = document.getElementById('install-confirm');
const dismissBtn = document.getElementById('install-dismiss');

// Do not show if already installed
const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone;
if (isStandalone) {
    card?.remove();
}

window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    if (card) card.classList.remove('hidden');
});

confirmBtn?.addEventListener('click', async () => {
    if (!deferredPrompt) return;
    try {
        deferredPrompt.prompt();
        await deferredPrompt.userChoice;
    } catch (err) {
        console.warn('Install prompt failed:', err);
    } finally {
        if (card) card.classList.add('hidden');
        deferredPrompt = null;
    }
});

dismissBtn?.addEventListener('click', () => {
    if (card) card.classList.add('hidden');
    deferredPrompt = null;
});
</script>
@stack('scripts')
</body>
</html>
