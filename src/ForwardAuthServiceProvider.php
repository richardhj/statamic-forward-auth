<?php

namespace Daynnnnn\Statamic\Auth\ForwardAuth;

use Daynnnnn\Statamic\Auth\ForwardAuth\AuthServices;
use Illuminate\Support\Facades\Auth;
use Statamic\Providers\AddonServiceProvider;

class ForwardAuthServiceProvider extends AddonServiceProvider
{
    public function boot()
    {
        Auth::provider('forward', function () {
            $class = $this->lookupType(config('auth.providers.users.type'));
            return new ForwardAuthUserProvider(new $class);
        });
    }

    protected function lookupType($type) {
        $types = [
            'http' => AuthServices\HttpAuthService::class,
        ];

        return $types[$type];
    }
}