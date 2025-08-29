<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
  // Proveedores permitidos
  protected $allowedProviders = ['google', 'facebook', 'github', 'twitter', 'linkedin'];

  // Redirige al usuario a la página de autenticación del proveedor
  public function redirect($provider)
  {
    // Validar que el proveedor sea permitido
    if (!in_array($provider, $this->allowedProviders)) {
      return redirect()->route('login')
        ->with('error', 'Proveedor de autenticación no válido.');
    }

    return Socialite::driver($provider)->redirect();
  }

  // Maneja el callback del proveedor
  public function callback($provider)
  {
    // Validar que el proveedor sea permitido
    if (!in_array($provider, $this->allowedProviders)) {
      return redirect()->route('login')
        ->with('error', 'Proveedor de autenticación no válido.');
    }

    try {
      $socialUser = Socialite::driver($provider)->user();

      // Buscar usuario existente por email o por provider_id
      $user = User::where('email', $socialUser->email)
                  ->orWhere(function($query) use ($provider, $socialUser) {
                      $query->where('provider', $provider)
                            ->where('provider_id', $socialUser->id);
                  })
                  ->first();

      if ($user) {
        // Usuario existe, actualizar campos de provider
        $user->update([
          'provider' => $provider,
          'provider_id' => $socialUser->id,
          'avatar' => $socialUser->avatar ?? $user->avatar,
        ]);
      } else {
        // Crear nuevo usuario
        $user = User::create([
          'name' => $socialUser->name ?? $socialUser->nickname ?? 'Usuario',
          'email' => $socialUser->email,
          'provider' => $provider,
          'provider_id' => $socialUser->id,
          'avatar' => $socialUser->avatar,
          'email_verified_at' => now(), // Asumimos que el proveedor ya verificó el email
          'password' => Hash::make(Str::random(24)), // Password aleatorio
        ]);
      }

      // Iniciar sesión del usuario
      Auth::login($user, true);

      // Redirigir al dashboard o página principal
      return redirect()->intended('/')
        ->with('success', 'Autenticación exitosa con ' . ucfirst($provider));

    } catch (\Exception $e) {
      return redirect()->route('login')
        ->with('error', 'Error durante la autenticación con ' . ucfirst($provider) . ': ' . $e->getMessage());
    }
  }

  // Método para API (si necesitas también autenticación vía API)
  public function callbackApi($provider)
  {
    try {
      $socialUser = Socialite::driver($provider)->user();

      // Buscar usuario existente por email
      $user = User::where('email', $socialUser->email)->first();

      if ($user) {
        // Usuario existe, actualizar campos de provider
        $user->update([
          'provider' => $provider,
          'provider_id' => $socialUser->id,
          'avatar' => $socialUser->avatar,
        ]);
      } else {
        // Crear nuevo usuario
        $user = User::create([
          'name' => $socialUser->name,
          'email' => $socialUser->email,
          'provider' => $provider,
          'provider_id' => $socialUser->id,
          'avatar' => $socialUser->avatar,
          'email_verified_at' => now(),
          'password' => Hash::make(Str::random(24)),
        ]);
      }

      // Crear token para API (si usas Passport)
      $token = $user->createToken('Google Auth Token')->accessToken;

      return response()->json([
        'message' => 'Autenticación exitosa',
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'Bearer',
      ]);

    } catch (\Exception $e) {
      return response()->json([
        'error' => 'Error durante la autenticación',
        'message' => $e->getMessage()
      ], 500);
    }
  }
}
