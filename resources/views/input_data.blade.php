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
    @error('rule_id')
    <p>ERROR:{{$message}}</p>
    @enderror
    <label for="rule_id">ルール</label>
    <select name="rule_id">
    <option value="" disabled selected>選択してください</option>
    @foreach($rules as $rule)
        <option value="{{ $rule->rule_id }}" @if(old('rule_id')==$rule->rule_id) selected @endif>{{ $rule->rule_name }}</option>
    @endforeach
    </select>
    <br>
    @error('stage1_id')
    <p>ERROR:{{$message}}</p>
    @enderror
    @error('stage2_id')
    <p>ERROR:{{$message}}</p>
    @enderror
    <label for="stage1_id">ステージ1</label>
    <select name="stage1_id">
    <option value="" disabled selected>選択してください</option>
    @foreach($stages as $stage)
        <option value="{{ $stage->stage_id }}" @if(old('stage1_id')==$stage->stage_id) selected @endif>{{ $stage->stage_name }}</option>
    @endforeach
    </select>
    <label for="stage2_id">ステージ2</label>
    <select name="stage2_id">
    <option value="" disabled selected>選択してください</option>
    @foreach($stages as $stage)
    <option value="{{ $stage->stage_id }}" @if(old('stage2_id')==$stage->stage_id) selected @endif>{{ $stage->stage_name }}</option>
    @endforeach
    </select>
    <br>
    @error('buki_id')
    <p>ERROR:{{$message}}</p>
    @enderror
    <label for="buki_id">ブキ</label>
    <select name="buki_id">
    <option value="" disabled selected>選択してください</option>
    @foreach($bukis as $buki)
        <option value="{{ $buki->buki_id }}" @if(old('buki_id')==$buki->buki_id) selected @endif>{{ $buki->buki_name }}</option>
    @endforeach
    </select>
    <br>
    @error('xp')
    <p>ERROR:{{$message}}</p>
    @enderror
    <label for="xp">ウデマエポイント</label>
    <input type="text" name="xp" value="{{ old('xp') }}">
    <br>
    <input type="submit">
    </form>
</body>
</html>