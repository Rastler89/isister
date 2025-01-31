<?php

namespace App\Listeners;

use Laravel\Passport\Events\AccessTokenCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AddUserToTokenResponse
{
    public function handle(AccessTokenCreated $event)
    {
        $user = \App\Models\User::find($event->userId);

        // Modificar la respuesta HTTP directamente
        Response::macro('withUser', function ($tokenData) use ($user) {
            return response()->json(array_merge($tokenData, [
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ]));
        });
    }
}