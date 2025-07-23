<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Http;

trait FetchesUserProfile
{
    /**
     * Récupère le profil utilisateur depuis l'API JWT
     *
     * @param string|null $token
     * @return array|null
     */
    public function fetchUserProfile(?string $token = null): ?array
    {
        try {
            $token = $token ?? session('token');

            if (!$token) {
                return null;
            }

            $response = Http::withToken($token)
                ->post(config('services.jwt.profile_endpoint', 'http://jwt-auth-laravel.test/api/auth/profile'));

            if ($response->ok()) {
                return $response->json('data');
            }
        } catch (\Exception $e) {
            // Log::error('Erreur lors de la récupération du profil : ' . $e->getMessage());
        }

        return null;
    }
}
