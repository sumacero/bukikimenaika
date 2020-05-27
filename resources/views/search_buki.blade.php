@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')

@section('h1', 'オススメブキ検索')

@section('content')
    <form action="/search_buki" method="post">
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
    <input type="submit" value="検索">
    </form>

    @if(Session::has('items'))
    <table>
    <tr>
    <th>オススメ順</th>
    <th>ブキ名</th>
    <th>平均ＸＰ</th>
    </tr>
    @foreach( session('items') as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->buki->buki_name}}</td>
            <td>{{$item->total}}</td>
        </tr>
    @endforeach
    </table>
    @endif
@endsection