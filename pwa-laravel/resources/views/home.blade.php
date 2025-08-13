@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1 class="text-2xl font-semibold mb-2">Welcome 👋</h1>
    <p class="text-slate-600 dark:text-slate-400">This is your new Laravel PWA homepage.</p>

    <div class="mt-4 flex gap-3 flex-wrap">
        <a class="inline-flex items-center rounded-lg bg-sky-600 hover:bg-sky-700 text-white px-4 py-2" href="/">Home</a>
        <a class="inline-flex items-center rounded-lg border border-slate-300 dark:border-slate-700 px-4 py-2" href="/offline">Try offline page</a>
    </div>

    <p class="text-sm text-slate-500 dark:text-slate-400 mt-4">
        PWA is enabled. The app registers <span class="font-mono bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded">/serviceworker.js</span>
        and uses <span class="font-mono bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded">/manifest.webmanifest</span>.
    </p>
@endsection
