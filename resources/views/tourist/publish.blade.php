@extends('layouts.app')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
<script src="{{ asset('js/publish.js') }}"></script>

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Publish a project') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
      <div>
        <input type="text" name="destination" id="destination">
      </div>
    </div>

</div>
@endsection
