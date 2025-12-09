<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request, Client $client): Response
    {
        $user = $request->user();

        if (! $user || $user->client_id !== $client->id) {
            abort(403);
        }

        $sensors = [
            [
                'id' => 1,
                'name' => 'Sensore Indoor 1',
                'type' => 'indoor',
                'status' => 'ok',
                'last_value' => '22.5°C',
                'updated_at' => now()->subMinutes(5)->toDateTimeString(),
            ],
            [
                'id' => 2,
                'name' => 'Sensore Outdoor',
                'type' => 'outdoor',
                'status' => 'warning',
                'last_value' => '35.1°C',
                'updated_at' => now()->subMinutes(12)->toDateTimeString(),
            ],
            [
                'id' => 3,
                'name' => 'Sensore Idrico',
                'type' => 'water',
                'status' => 'alarm',
                'last_value' => '12.3 L/min',
                'updated_at' => now()->subMinutes(25)->toDateTimeString(),
            ],
        ];

        return Inertia::render('Client/Dashboard', [
            'client' => $client->only('id', 'name', 'slug'),
            'user' => $user->only('id', 'name', 'email'),
            'sensors' => $sensors,
        ]);
    }
}
