@extends('layouts.app')

@section('title', config('app.name', 'Laravel') . ' - Autorización OAuth')

@section('content')
  <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 max-w-lg mx-auto">
    <div class="text-center mb-8">
      <h1 class="text-2xl font-bold text-gray-900 mb-2">Autorización de aplicación</h1>
    </div>

    <div class="mb-6">
      <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200 mb-4">
        <h2 class="text-xl font-semibold text-blue-900 mb-2">{{ $client->name }}</h2>
        <p class="text-blue-700">La aplicación <strong>{{ $client->name }}</strong> está solicitando permiso para acceder a tu cuenta.</p>
      </div>
    </div>

    @if (count($scopes) > 0)
      <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-3">Esta aplicación podrá:</h3>
        <ul class="space-y-2">
          @foreach ($scopes as $scope)
            <li class="flex items-center text-gray-700">
              <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
              {{ $scope->description }}
            </li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="flex space-x-3">
      <form method="POST" action="{{ route('passport.authorizations.approve') }}" class="flex-1">
        @csrf

        <input type="hidden" name="state" value="{{ $request->state }}">
        <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
        <input type="hidden" name="auth_token" value="{{ $authToken }}">
        <input type="hidden" name="response_type" value="{{ $request->response_type }}">
        <input type="hidden" name="scope" value="{{ $request->scope }}">
        <input type="hidden" name="code_challenge" value="{{ $request->code_challenge }}">
        <input type="hidden" name="code_challenge_method" value="{{ $request->code_challenge_method }}">
        <input type="hidden" name="redirect_uri" value="{{ $request->redirect_uri }}">

        <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
          Autorizar
        </button>
      </form>

      <form method="POST" action="{{ route('passport.authorizations.deny') }}" class="flex-1">
        @csrf

        <input type="hidden" name="state" value="{{ $request->state }}">
        <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
        <input type="hidden" name="auth_token" value="{{ $authToken }}">
        <input type="hidden" name="response_type" value="{{ $request->response_type }}">
        <input type="hidden" name="scope" value="{{ $request->scope }}">
        <input type="hidden" name="code_challenge" value="{{ $request->code_challenge }}">
        <input type="hidden" name="code_challenge_method" value="{{ $request->code_challenge_method }}">
        <input type="hidden" name="redirect_uri" value="{{ $request->redirect_uri }}">

        <button type="submit" class="w-full bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
          Cancelar
        </button>
      </form>
    </div>

    <div class="mt-6">
        <p class="text-xs text-gray-500 text-center">
          Al autorizar, permites que
          <strong>{{ $client->name }}</strong>
          acceda a tu información según los permisos solicitados.
        </p>
    </div>
  </div>
@endsection
