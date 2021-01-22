@extends('layouts.app')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{ asset('js/publish.js') }}"></script>

@section('content')

<form method="POST" action="{{ localized_route('tourist.publish') }}">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ __('Publish a project') }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <input type="text" name="destination" id="destination"  value="{{ old('destination') }}">
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
                <input type="text" name="ville" value="{{ old('ville') }}">
                <input type="text" name="code_departement" value="{{ old('code_departement') }}">
                <input type="text" name="latitude" value="{{ old('latitude') }}">
                <input type="text" name="longitude" value="{{ old('longitude') }}">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <input type="submit">
            </div>
        </div>
     </div>
</form>
@endsection
