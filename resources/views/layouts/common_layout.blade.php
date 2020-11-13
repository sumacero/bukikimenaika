<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>@yield('h1')</h1>
    <h2>メニュー</h2>
    <ul>
        <li>{{Form::button('データ編集',['onclick' => 'location.href="./edit_data"'])}}</li>
        <li>{{Form::button('ガチマッチ情報参照',['onclick' => 'location.href="./view_gachi"'])}}</li>
        <li>{{Form::button('オススメブキ検索',['onclick' => 'location.href="./search_buki"'])}}</li>
    </ul>
    <hr size="1">
    <div class="content">
    @yield('content')
    </div>

    <div>
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </div>
    
    <div class="footer">
    copyright 2020 suto.
    </div>
    <script src=" {{ asset('js/app.js') }} "></script>
    @yield('vue')
</body>
</html>