@php
    $title = __('You\'ve verified your email address.');
@endphp

@extends('layouts.common_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('You\'ve verified your email address.') }}</div>
                <div class="card-body" >
                    <a href="{{ url('/') }}/view_gachi">{{ __('Let\'s get started.') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection