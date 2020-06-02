@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')

@section('h1', 'データ編集')

@section('content')
    <form action="/insert_data" method="post">
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
    <input type="submit" value="データ追加">
    </form>
    <table>
    <tr>
    <th>ルールID</th>
    <th>ルール名</th>
    <th>ステージ1ID</th>
    <th>ステージ1名</th>
    <th>ステージ2ID</th>
    <th>ステージ2名</th>
    <th>ブキID</th>
    <th>ブキ名</th>
    <th>ＸＰ</th>
    <th></th>
    <th></th>
    <th>user_name</th>
    </tr>
    @foreach($input_datas as $input_data)
        <tr>
            <td>{{$input_data->rule_id}}</td>
            <td>{{$input_data->rule->rule_name}}</td>
            <td>{{$input_data->stage1_id}}</td>
            <td>{{$input_data->stage1->stage_name}}</td>
            <td>{{$input_data->stage2_id}}</td>
            <td>{{$input_data->stage2->stage_name}}</td>
            <td>{{$input_data->buki_id}}</td>
            <td>{{$input_data->buki->buki_name}}</td>
            <td>{{$input_data->xp}}</td>
			<td><button type="button" class="editBtn btn btn-info">編集</button></td>
			<td><button type="button" class="deleteBtn btn btn-info">削除</button></td>
            <td>{{$input_data->user->user_name}}</td>
        </tr>
    @endforeach
    </table>
    <div id="app"><message v-bind:input_datas="{{ ($input_datas) }}"></message></div>
    <div id="app1">@{{ msg }}</div>
    

    
    
@endsection

@section('vue')
<script>
new Vue({
    el: '#app1',
    data: {
        msg: 'vueのメッセージです'
    }
});
</script>
@endsection


