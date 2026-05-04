@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
	<h1 class="text-2xl font-bold mb-6">Login</h1>
	<form method="POST" action="/login" class="space-y-4">
		@csrf
		<div>
			<label for="email" class="block mb-1">Email</label>
			<input id="email" type="email" name="email" required autofocus class="w-full border p-2 rounded">
		</div>
		<div>
			<label for="password" class="block mb-1">Password</label>
			<input id="password" type="password" name="password" required class="w-full border p-2 rounded">
		</div>
		@if($errors->any())
			<div class="text-red-500 text-sm">
				{{ $errors->first() }}
			</div>
		@endif
		<button class="bg-blue-600 text-white px-4 py-2 rounded w-full">Login</button>
		<div class="text-center mt-4">
			<a href="/register" class="text-blue-600 hover:underline">Don't have an account? Register</a>
		</div>
	</form>
</div>
@endsection