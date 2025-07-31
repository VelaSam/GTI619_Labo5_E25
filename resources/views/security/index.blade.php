@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Configuration des paramètres de sécurité</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('security.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="password_min_length">Longueur minimale du mot de passe:</label>
                                <input type="number" class="form-control @error('password_min_length') is-invalid @enderror"
                                    id="password_min_length" name="password_min_length"
                                    value="{{ $settings['password_min_length'] }}" min="6" max="50">
                                @error('password_min_length')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="password_require_lowercase"
                                        name="password_require_lowercase" {{ $settings['password_require_lowercase'] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="password_require_lowercase">
                                        Exiger au moins une lettre minuscule
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="password_require_uppercase"
                                        name="password_require_uppercase" {{ $settings['password_require_uppercase'] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="password_require_uppercase">
                                        Exiger au moins une lettre majuscule
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="password_require_digit"
                                        name="password_require_digit" {{ $settings['password_require_digit'] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="password_require_digit">
                                        Exiger au moins un chiffre
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="password_require_special"
                                        name="password_require_special" {{ $settings['password_require_special'] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="password_require_special">
                                        Exiger au moins un caractère spécial
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Mettre à jour les paramètres
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
