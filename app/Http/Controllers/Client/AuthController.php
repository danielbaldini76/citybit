<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function showLoginForm(Client $client): Response
    {
        return Inertia::render('Client/Login', [
            'client' => $client->only('id', 'name', 'slug'),
        ]);
    }

    public function login(Request $request, Client $client): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable', 'boolean'],
        ]);

        $attempt = Auth::attempt(
            [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
                'client_id' => $client->id,
            ],
            $request->boolean('remember')
        );

        if ($attempt) {
            $request->session()->regenerate();

            return redirect()->route('client.dashboard', ['client' => $client]);
        }

        return back()
            ->withErrors([
                'email' => __('These credentials do not match our records.'),
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request, Client $client): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('client.login', ['client' => $client]);
    }
}
