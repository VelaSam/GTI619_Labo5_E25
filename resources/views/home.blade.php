@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in, {{ Auth::user()->name }}!

                    @can ('view_admin_page')
                        <div class="mt-3">
                            <a href="{{ url('/home/client') }}" class="btn btn-primary">
                                Options Admin
                            </a>
                        </div>
                    @endcan

                    @can ('view_page_prep_residentiels')
                        <div class="mt-3">
                            <a href="{{ url('/home/client') }}" class="btn btn-primary">
                                Clients résidentiels
                            </a>
                        </div>
                    @endcan
                    @can ('view_page_prep_affaire')
                        <div class="mt-3">
                            <a href="{{ url('/home/client') }}" class="btn btn-primary">
                                Clients d'affaire
                            </a>
                        </div>
                    @endcan
                    <div class="mt-3">
                        <a href="{{ url('/home/client') }}" class="btn btn-primary">
                            Go to Clients
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
