<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AppendUserToTokenResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Verificar si es la ruta /oauth/token y respuesta exitosa
        if ($request->is('oauth/token') && $response->getStatusCode() === 200) {
            $data = json_decode($response->getContent(), true);
            $accessToken = $data['access_token'];

            // Decodificar el payload del JWT
            $tokenParts = explode('.', $accessToken);
            if (count($tokenParts) !== 3) {
                return $response; // Token inválido
            }

            $payload = json_decode(base64_decode(strtr($tokenParts[1], '-_', '+/')), true);

            // Obtener el user_id desde el JWT
            if (isset($payload['sub'])) {
                $user = User::find($payload['sub']);

                if ($user) {
                    $data['user'] = [
                        'name' => $user->name,
                        'email' => $user->email,
                    ];
                    $response->setContent(json_encode($data));
                }
            }
        }

        return $response;
    }
}