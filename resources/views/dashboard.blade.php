@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Personal Information</h1>
    <div class="personal-info-card">
        <p><span class="font-semibold">Name:</span> {{ Auth::user()->name ?? 'N/A' }}</p>
        <p><span class="font-semibold">Email:</span> {{ Auth::user()->email ?? 'N/A' }}</p>
        <!-- Add more fields as needed -->
    </div>
    <a href="/" class="text-blue-600 underline">Go to Notes</a>
</div>
@endsection
