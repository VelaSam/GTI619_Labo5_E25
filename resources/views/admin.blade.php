@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Options de gestion de mot de passe') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.update.passTime', ) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="interval_minutes" class="col-md-4 col-form-label text-md-end">Intervalle de
                                    temps avec password reset (en minutes):</label>
                                <div class="col-md-6">
                                    <input type="number" name="interval_minutes" min="1" class="form-control"
                                        value="{{ old('interval_minutes') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password_history_limit" class="col-md-4 col-form-label text-md-end">Nombre de
                                    mots de passe à retenir dans l'historique:</label>
                                <div class="col-md-6">
                                    <input type="number" name="password_history_limit" min="1" max="20" class="form-control"
                                        value="{{ old('password_history_limit', 5) }}">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Options configuration du changement de mot de passe') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Ajouter un utilisateur') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/adminRegister') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-end">Role</label>

                                <div class="col-md-6">
                                    <select id="role" name="role" class="form-control" required>
                                        <option value="Administrateur">Administrateur</option>
                                        <option value="Préposé aux clients résidentiels">Préposé aux clients résidentiels
                                        </option>
                                        <option value="Préposé aux clients d’affaire">Préposé aux clients d’affaire</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ajouter') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
