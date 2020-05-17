<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブキキメナイカ</title>
</head>
<body>
    <h1>ホーム</h1>
    {{Form::button('データ入力',['onclick' => 'location.href="./input_data"'])}}
    {{Form::button('データ参照',['onclick' => 'location.href="./view_data"'])}}
    {{Form::button('オススメブキ検索',['onclick' => 'location.href="./search_buki"'])}}
</body>
</html>