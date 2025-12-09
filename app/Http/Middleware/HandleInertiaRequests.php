<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
<<<<<<< HEAD
     * The root template that is loaded on the first page visit.
=======
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
>>>>>>> ada0ac8 (Add Inertial)
     */
    protected $rootView = 'app';

    /**
<<<<<<< HEAD
     * Determine the current asset version.
=======
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
>>>>>>> ada0ac8 (Add Inertial)
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
<<<<<<< HEAD
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user()?->only('id', 'name', 'email', 'client_id'),
            ],
            'csrf_token' => csrf_token(),
        ]);
=======
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            //
        ];
>>>>>>> ada0ac8 (Add Inertial)
    }
}
