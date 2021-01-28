@extends('layouts.app')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<script src="{{ asset('js/publish.js') }}"></script>
<script src="{{ asset('js/calendar-'.locale().'.js') }}"></script>

@section('content')

<form method="POST" action="{{ localized_route('tourist.publish') }}">
    @csrf
    <input type="hidden" name="lang" id="lang" value="{{ locale() }}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ __('Publish a project') }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <input type="text" name="destination" id="destination" placeholder="{{ __('Choose a destination') }}" value="{{ old('destination') }}">
                @if ($errors->has('destination'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('destination') }}</strong>
                    </div>
                @else
                    @if ($errors->has('ville') || $errors->has('latitude') || $errors->has('longitude') || $errors->has('code_departement'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ __('Please select a destination in the list') }}</strong>
                        </div>
                    @endif
                @endif
                <input type="hidden" name="ville" value="{{ old('ville') }}">
                <input type="hidden" name="code_departement" value="{{ old('code_departement') }}">
                <input type="hidden" name="latitude" value="{{ old('latitude') }}">
                <input type="hidden" name="longitude" value="{{ old('longitude') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <label>{{ __('From') }}</label>
                <input type="text" name="date_start" id="date_start" placeholder="{{ __('Start date') }}" value="{{ old('date_start') }}">
                @error('date_start')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label>{{ __('To') }}</label>
                <input type="text" name="date_end" id="date_end" placeholder="{{ __('End date') }}" value="{{ old('date_end') }}">
                @error('date_end')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        @if (!Auth::user())
            <div class="row">
                <div class="col-12">
                    <label>{{ __('E-mail address') }}</label>
                    <input type="text" name="email" id="email" placeholder="{{ __('E-mail address') }}" value="{{ old('email') }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <input type="submit">
            </div>
        </div>
     </div>
</form>
@endsection
