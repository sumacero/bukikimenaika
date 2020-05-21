<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブキキメナイカ</title>
</head>
<body>
    <h1>データ入力</h1>
    <form action="/input_data" method="post">
    @csrf
    <label for="rule_id">ルール</label>
    <select name="rule_id">
    @foreach($rules as $rule)
        <option value="{{ $rule->rule_id }}">{{ $rule->rule_name }}</option>
    @endforeach
    </select>
    <label for="stage1_id">ステージ1</label>
    <select name="stage1_id">
    @foreach($stages as $stage)
        <option value="{{ $stage->stage_id }}">{{ $stage->stage_name }}</option>
    @endforeach
    </select>

    <label for="stage2_id">ステージ2</label>
    <select name="stage2_id">
    @foreach($stages as $stage)
        <option value="{{ $stage->stage_id }}">{{ $stage->stage_name }}</option>
    @endforeach
    </select>

    <label for="buki_id">ブキ</label>
    <select name="buki_id">
    @foreach($bukis as $buki)
        <option value="{{ $buki->buki_id }}">{{ $buki->buki_name }}</option>
    @endforeach
    </select>

    <label for="xp">ウデマエポイント</label>
    <input type="text" name="xp">
    </form>
</body>
</html>