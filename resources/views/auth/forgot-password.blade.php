@extends('layouts.app')

@section('title', config('app.name', 'Laravel') . ' - Recuperar contraseña')

@section('content')
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
    <div class="text-center mb-8">
      <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ config('app.name', 'Laravel') }}</h1>
      <p class="text-gray-600">Recupera tu contraseña</p>
    </div>

    <div class="mb-6">
      <p class="text-sm text-gray-600 text-center">
        ¿Olvidaste tu contraseña? No hay problema. Solo dinos tu dirección de correo electrónico y te enviaremos un
        enlace para restablecer tu contraseña.
      </p>
    </div>

    @if (session('status'))
      <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md">
        <p class="text-sm text-green-600">{{ session('status') }}</p>
      </div>
    @endif

    @if ($errors->any())
      <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
        @foreach ($errors->all() as $error)
          <p class="text-sm text-red-600">{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo electrónico</label>
        <input id="email" name="email" type="email" autocomplete="email" required
          value="{{ old('email') }}" placeholder="tu@email.com"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
      </div>

      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
        Enviar enlace de recuperación
      </button>
    </form>

    <div class="mt-6 text-center">
      <p class="text-sm text-gray-600">
        ¿Recordaste tu contraseña?
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Volver al inicio de sesión</a>
      </p>
    </div>
  </div>
@endsection
