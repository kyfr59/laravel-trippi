@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Password changed') }}</div>
                <div class="card-body">
                    <h3>{{__('Your password has been changed and you\'re now login on Trippi !')}}</h3>
                </div>
                @if (session('project'))
                <div class="card-body">
                    <p>{{__('You have a pending project')}}</p>
                    <a href="{{ localized_route('tourist.publish') }}" class="btn btn-primary">Publish my project</a>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
