@extends('layouts.app')

@section('title', config('app.name', 'Laravel') . ' - Autorización OAuth')

@section('content')
  <div>
    <h1>Autorización de aplicación</h1>

    <div>
      <h2>{{ $client->name }}</h2>
      <p>La aplicación <strong>{{ $client->name }}</strong> está solicitando permiso para acceder a tu cuenta.</p>
    </div>

    @if (count($scopes) > 0)
      <div>
        <h3>Esta aplicación podrá:</h3>
        <ul>
          @foreach ($scopes as $scope)
            <li>{{ $scope->description }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div>
      <form method="POST" action="{{ route('passport.authorizations.approve') }}">
        @csrf

        <input type="hidden" name="state" value="{{ $request->state }}">
        <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
        <input type="hidden" name="auth_token" value="{{ $authToken }}">
        <input type="hidden" name="response_type" value="{{ $request->response_type }}">
        <input type="hidden" name="scope" value="{{ $request->scope }}">
        <input type="hidden" name="code_challenge" value="{{ $request->code_challenge }}">
        <input type="hidden" name="code_challenge_method" value="{{ $request->code_challenge_method }}">
        <input type="hidden" name="redirect_uri" value="{{ $request->redirect_uri }}">

        <button type="submit">Autorizar</button>
      </form>
    </div>

    <div>
        <p>
          <small>
            Al autorizar, permites que
          <strong>{{ $client->name }}</strong>
          acceda a tu información según los permisos solicitados.
          </small>
        </p>
    </div>
  </div>
@endsection
