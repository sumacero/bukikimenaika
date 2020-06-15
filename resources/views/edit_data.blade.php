@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')

@section('h1', 'データ編集')

@section('content')
    <div id="app1">
    <button v-on:click="switchInsertRecord()">データの追加</button>
    <insert-record v-show="showInsertRecord" v-on:click-insert-btn="submitInsertRecord($event)" v-on:click-cancel-insert-btn="switchInsertRecord()" v-bind:rules="{{ $rules }}" v-bind:stages="{{ $stages }}" v-bind:bukis="{{ $bukis }}">
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
        showInsertRecord: false,
        'user_id': null,
        'rule_id': null,
        'stage1_id': null,
        'stage2_id': null,
        'buki_id': null,
        'xp': null
    },
    methods:{
        switchInsertRecord: function() {
            this.showInsertRecord = !this.showInsertRecord
        },
        submitInsertRecord: function(insertRecord){
            console.log(insertRecord);
            var article = {
                'user_id': 1,
                'rule_id': insertRecord.rule_id,
                'stage1_id': insertRecord.stage1_id,
                'stage2_id': insertRecord.stage2_id,
                'buki_id': insertRecord.buki_id,
                'xp': insertRecord.xp,
            };
            // POST
            // axios.postの第１引数にルートを、第２引数にポストするデータの配列を渡します
            axios.post('/api/insert_data/',article).then(res => {
            // テストのため返り値をコンソールに表示
            console.log(res.data.xp);
            });
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


