@php
    $title = __('You\'ve verified your email address.');
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('You\'ve verified your email address.') }}</div>

                <div class="card-body" >
                    <a href="home">{{ __('Let\'s get started.') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection