@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')

@section('h1', 'データ編集')

@section('content')
    <div id="app1">
    <button v-on:click="switchInsertRecord()">データの追加</button>
    <insert-record v-show="showInsertRecord" v-on:click-insert-btn="submitInsertRecord()" v-on:click-cancel-insert-btn="switchInsertRecord()" v-bind:rules="{{ $rules }}" v-bind:stages="{{ $stages }}" v-bind:bukis="{{ $bukis }}">
    </insert-record>
    <edit-table v-bind:input_datas="{{ $input_datas }}" v-bind:rules="{{ $rules }}" v-bind:stages="{{ $stages }}" v-bind:bukis="{{ $bukis }}">
    </edit-table>
    </div>
    <div id="app2">@{{ msg }}</div>
    <div id="app3">@{{ msg }}</div>
@endsection

@section('vue')
<script>
new Vue({
    el: '#app1',
    data: {
        showInsertRecord: false
    },
    methods:{
        switchInsertRecord: function() {
            this.showInsertRecord = !this.showInsertRecord
        },
        submitInsertRecord: function(){
            alert('追加ボタンが押されました');
        }
    }
});
new Vue({
    el: '#app2',
    data: {
        msg: 'vue1のメッセージです'
    }
});
new Vue({
    el: '#app3',
    data: {
        msg: 'vue2のメッセージです'
    }
});
</script>
@endsection


