<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
  // Redirige al usuario a la página de autenticación de Google
  public function redirect($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  // Maneja el callback de Google
  public function callback($provider)
  {
    try {
      $user = Socialite::driver($provider)->stateless()->user();
      // Aquí puedes manejar la lógica de registro o inicio de sesión del usuario
      // Por ejemplo, buscar o crear un usuario en tu base de datos
      // Luego, generar un token de API para el usuario y devolverlo en la respuesta

      return response()->json([
        'message' => 'Autenticación exitosa',
        'user' => $user,
      ]);
    } catch (\Exception $e) {
      return response()->json(['error' => 'Error durante la autenticación'], 500);
    }
  }
}
