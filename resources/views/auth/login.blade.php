@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
	<h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
	<form method="POST" action="/login" class="space-y-4">
		@csrf
		
		<div class="glass-card shadow-lg">
			<div class="card-body text-center" id="weather">
				@if(isset($weather))
					<h2>{{ $weather['city'] }}</h2>
					<div style="font-size: 1.8rem; font-weight: bold;">
						{{ $weather['temperature'] }}°C
						<p>{{ $weather['description'] }}</p>
					</div>
				@else
					<p>Weather data not available.</p>
				@endif
			</div>
		</div>
		<script>
			async function loadWeather() {
				try {
					const response = await fetch('/api/weather');
					const data = await response.json();
					if (data.success) {
						const weatherDiv = document.getElementById('weather');
						weatherDiv.innerHTML = `
							<h2>${data.weather.city}</h2>
							<div style="font-size: 1.8rem; font-weight: bold;">
								${data.weather.temperature}°C
								${data.weather.description}
							</div>
						`;
					}
				} catch (error) {
					console.error('Error fetching weather:', error);
				}
			}
			loadWeadther();
			setInterval(loadWeather, 60000);
		</script>

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