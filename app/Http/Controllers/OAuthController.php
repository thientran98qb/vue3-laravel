<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    /**
     * @param string $provider
     *
     * @return Response
     */
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleCallbackProvider(string $provider)
    {
        $userSocial = Socialite::driver($provider)->user();

        $userAuth = $this->createOrUpdateUser($userSocial, $provider);

        Auth::login($userAuth);

        return response()->json($userAuth);
    }

    private function createOrUpdateUser($user, $provider)
    {
        $authUser = User::query()->whereHas('socialAccountUsers', function ($query) use ($user) {
            $query->where('provider_id', $user->id);
        })->first();

        if ($authUser) {
            return $authUser;
        }

        $newUser = User::create([
            'name' => $user->getName() ?? '',
            'email' => $user->email,
            'avatar' => $user->getAvatar()
        ]);
        $newUser->socialAccountUsers()->create([
            'provider' => $provider,
            'provider_id' => $user->id
        ]);

        return $newUser;
    }
}
