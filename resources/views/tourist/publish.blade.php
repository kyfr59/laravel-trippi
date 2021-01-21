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
                <input type="text" name="destination" id="destination">
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
