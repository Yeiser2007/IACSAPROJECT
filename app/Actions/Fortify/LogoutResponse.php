<?php namespace App\Actions\Fortify;

use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? new JsonResponse(['message' => 'Logged out'], 204)
            : redirect('/login'); // 🔹 Cambia la ruta a "/login"
    }
}
