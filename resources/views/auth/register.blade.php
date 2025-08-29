@extends('layouts.app')

@section('title', config('app.name', 'Laravel') . ' - Registro')

@section('content')
    <div>
        <h1>{{ config('app.name', 'Laravel') }}</h1>
        <p>Crea tu cuenta</p>

        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name">Nombre completo</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    autocomplete="name"
                    required
                    value="{{ old('name') }}"
                    placeholder="Tu nombre completo">
            </div>

            <div>
                <label for="email">Correo electrónico</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    value="{{ old('email') }}"
                    placeholder="tu@email.com">
            </div>

            <div>
                <label for="password">Contraseña</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    required
                    placeholder="••••••••">
            </div>

            <div>
                <label for="password_confirmation">Confirmar contraseña</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    required
                    placeholder="••••••••">
            </div>

            <button type="submit">Registrarse</button>
        </form>

        @if (Route::has('login'))
            <div>
                <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a></p>
            </div>
        @endif
    </div>
@endsection
