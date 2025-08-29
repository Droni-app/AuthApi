@extends('layouts.app')

@section('title', config('app.name', 'Laravel') . ' - Login')

@section('content')
    <div>
        <h1>{{ config('app.name', 'Laravel') }}</h1>
        <p>Inicia sesión en tu cuenta</p>

        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                    autocomplete="current-password"
                    required
                    placeholder="••••••••">
            </div>

            <div>
                <input id="remember" name="remember" type="checkbox">
                <label for="remember">Recordarme</label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                @endif
            </div>

            <button type="submit">Iniciar sesión</button>
        </form>

        @if (Route::has('register'))
            <div>
                <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
            </div>
        @endif
    </div>
@endsection
