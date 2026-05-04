<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    //login
    public function showLogin()
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        $city = 'Sogod, Southern Leyte';

        $weather = null;
        try {
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");
            if ($response->successful()) {
                $data = $response->json();

                $weather = [
                    'temperature' => $data['main']['temp'],
                    'description' => $data['weather'][0]['description'],
                    'city' => $data['name']
                ];
            }
        } catch (\Exception $e) {
            // Handle exceptions (e.g., log the error)
            $weather = null;
        }
        return view('auth.login', compact('weather'));
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {   
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    //registration
    public function showRegform()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' =>['required', 'string', 'max:255'],
            'email' =>['required', 'string', 'max:255', 'unique:users'],
            'password' =>['required', 'string', 'min:8', 'confirmed'],
            'admin_key' => ['nullable', 'string'],
        ]);

        $role = 0;
        if (!empty($request->admin_key) && $request->admin_key === 'admin123') {
            $role = 1; // Set role to 1 for admin
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $role
        ]);

        Auth::login($user);
        return redirect()->intended('dashboard')->with('success', $role === 1 ? 'Admin registration successful!' : 'Registration successful!');
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request ->session()->invalidate();
        $request ->session()->regenerateToken();

        return redirect('/');
    }
   
    public function store(Request $request)
    {
        $role = 0;

        if ($request->admin_key === 'admin123') {
            $role = 1; // Set role to 1 for admin
    }
    
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $role
    ]);
    }
}