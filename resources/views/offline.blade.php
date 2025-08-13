@extends('layouts.app')

@section('title', 'Offline')

@section('content')
    <h1 class="text-2xl font-semibold mb-2">You are offline</h1>
    <p class="text-slate-600 dark:text-slate-400">No internet connection. This is the offline fallback page.</p>
    <div class="mt-4">
        <a class="inline-flex items-center rounded-lg bg-sky-600 hover:bg-sky-700 text-white px-4 py-2" href="/">Back to Home</a>
    </div>
@endsection
