<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>@yield('title')</h1>
    <h2>メニュー</h2>
    <ul>
        <li>{{Form::button('データ入力',['onclick' => 'location.href="./input_data"'])}}</li>
        <li>{{Form::button('データ参照',['onclick' => 'location.href="./view_data"'])}}</li>
        <li>{{Form::button('オススメブキ検索',['onclick' => 'location.href="./search_buki"'])}}</li>
    </ul>
    <hr size="1">
    <div class="content">
    @yield('content')
    </div>
    <div class="footer">
    copyright 2020 suto.
    <div>
</body>
</html>