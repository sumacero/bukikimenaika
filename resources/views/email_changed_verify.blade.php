@extends('layouts.common_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メールアドレスを変更しました。</div>
                <div class="card-body" >
                    <a href="{{ url('/') }}/view_gachi">ブキキメナイカをスタート</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection