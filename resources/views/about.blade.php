@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')

@section('h1', 'ホーム')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ブキキメナイカについて</div>
                <div class="card-body" >
                    <p>ブキキメナイカは<a href="https://twitter.com/bukikimenaika">わたくし</a>個人がWEBサービス開発の勉強のため作成しました。</p>
                    <p>当サービスについての問い合わせ、要望等ございましたら<a href="https://twitter.com/bukikimenaika">ツイッターアカウント</a>へご連絡ください。</p>
                    <p>ステージ情報は、<a href="https://twitter.com/m_on_yu">yuu26/えむおん</a>様の<a href="https://spla2.yuu26.com/">API</a>により取得しています。</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

