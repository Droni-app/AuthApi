@extends('layouts.app')

@section('title', config('app.name', 'Laravel') . ' - Login')

@section('content')
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
    <div class="text-center mb-8">
      <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ config('app.name', 'Laravel') }}</h1>
      <p class="text-gray-600">Inicia sesión en tu cuenta</p>
    </div>

    @if ($errors->any())
      <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
        @foreach ($errors->all() as $error)
          <p class="text-sm text-red-600">{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <!-- Google Login Button -->
    <div class="mb-6">
      <a href="{{ route('auth.provider', 'google') }}" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
          <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
          <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
          <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
          <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
        </svg>
        Continuar con Google
      </a>
    </div>

    <!-- Divider -->
    <div class="relative mb-6">
      <div class="absolute inset-0 flex items-center">
        <div class="w-full border-t border-gray-300"></div>
      </div>
      <div class="relative flex justify-center text-sm">
        <span class="px-2 bg-white text-gray-500">O continúa con email</span>
      </div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo electrónico</label>
        <input
          id="email"
          name="email"
          type="email"
          autocomplete="email"
          required
          value="{{ old('email') }}"
          placeholder="tu@email.com"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
        <input
          id="password"
          name="password"
          type="password"
          autocomplete="current-password"
          required
          placeholder="••••••••"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
          <label for="remember" class="ml-2 block text-sm text-gray-700">Recordarme</label>
        </div>

        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">¿Olvidaste tu contraseña?</a>
        @endif
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
        Iniciar sesión
      </button>
    </form>

    @if (Route::has('register'))
      <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">Regístrate aquí</a></p>
      </div>
    @endif
  </div>
@endsection
