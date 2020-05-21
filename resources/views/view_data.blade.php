<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブキキメナイカ</title>
</head>
<body>
    <h1>入力データ一覧</h1>
    <table>
    <tr>
    <th>ブキID</th><th>ブキ名</th>
    </tr>
    @foreach($items as $item)
        <tr>
            <td>{{$item->buki_id}}</td>
            <td>{{$item->buki_name}}</td>
        </tr>
    @endforeach
    </table>
</body>
</html>