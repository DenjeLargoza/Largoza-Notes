@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Register</h1>
    <form method="POST" action="/register" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block mb-1">Name</label>
            <input id="name" type="text" name="name" required autofocus class="w-full border p-2 rounded">
        </div>
        <div>
            <label for="email" class="block mb-1">Email</label>
            <input id="email" type="email" name="email" required class="w-full border p-2 rounded">
        </div>
        <div class="relative">
            <label for="password" class="block mb-1">Password</label>
            <input id="password" type="password" name="password" required class="w-full border p-2 rounded pr-10">
            <button type="button" id="toggle-password" class="absolute right-2 top-8 text-xs text-gray-600">Show</button>
        </div>
        <div class="relative">
            <label for="password_confirmation" class="block mb-1">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full border p-2 rounded pr-10">
            <button type="button" id="toggle-password-confirmation" class="absolute right-2 top-8 text-xs text-gray-600">Show</button>
            <div id="password-match-message" class="text-sm mt-1"></div>
        </div>
        <div class="mb-3">
            <label for="form-label">Admin Key (optional)</label>
            <input type="text" name="admin_key" class="w-full border p-2 rounded" placeholder="Enter admin key if you have one">
        </div>
        @if($errors->any())
            <div class="text-red-500 text-sm">
                {{ $errors->first() }}
            </div>
        @endif
        <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">Register</button>
    </form>
</div>
@endsection
