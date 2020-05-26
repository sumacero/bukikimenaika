@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')
<table>
    <tr>
    <th>データID</th>
    <th>ユーザID</th>
    <th>ユーザ名</th>
    <th>ユーザパスワード</th>
    <th>ルールID</th>
    <th>ルール名</th>
    <th>ステージ1ID</th>
    <th>ステージ1名</th>
    <th>ステージ2ID</th>
    <th>ステージ2名</th>
    <th>ブキID</th>
    <th>ブキ名</th>
    <th>ＸＰ</th>
    <th>作成日時</th>
    <th>更新日時</th>
    </tr>
    @foreach($items as $item)
        <tr>
            <td>{{$item->input_data_id}}</td>
            <td>{{$item->user_id}}</td>
            <td>{{$item->user->user_name}}</td>
            <td>{{$item->user->user_password}}</td>
            <td>{{$item->rule_id}}</td>
            <td>{{$item->rule->rule_name}}</td>
            <td>{{$item->stage1_id}}</td>
            <td>{{$item->stage1->stage_name}}</td>
            <td>{{$item->stage2_id}}</td>
            <td>{{$item->stage2->stage_name}}</td>
            <td>{{$item->buki_id}}</td>
            <td>{{$item->buki->buki_name}}</td>
            <td>{{$item->xp}}</td>
            <td>{{$item->created_at}}</td>
            <td>{{$item->updated_at}}</td>
        </tr>
    @endforeach
    </table>
@section('content')
@endsection

