@extends('layouts.app')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href = "https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{ asset('js/publish.js') }}"></script>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }} - IDe TOURIST</div>

                <div class="card-body">
                    <form method="POST" action="{{ localized_route('tourist.login') }}">
                        @csrf

                        <input type="hidden" name="redirect_to" value="{{ localized_route('tourist.publish') }}">
                        <input type="hidden" id="email" name="email" value="{{ $email }}">

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="@error('password', 'login') is-invalid @enderror" name="password" autocomplete="current-password">

                                @error('password', 'login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('error')}}
                            </div>
                        @endif

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Publish my project') }}
                                </button>
                                <a href="{{ localized_route('tourist.publish') }}#" class="btn btn-primary">
                                    {{ __('Modify my project') }}
                                </a>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ localized_route('password.request') }}">
                                        {{ __('Forgot your password ?') }}
                                    </a>
                                @endif
                            </div>
                            <a class="btn btn-link" href="{{ localized_route('tourist.password') }}">
                                {{ __('Forgot your password ?') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
