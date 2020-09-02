@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')

@section('h1', 'データ編集')

@section('content')
    <div id="app1">
        <button v-on:click="switchInsertRecord()">データの追加</button>
        <insert-record v-if="showInsertRecord" v-on:click-cancel-insert-btn="switchInsertRecord" v-on:click-insert-btn="insertRecord" v-bind:rules="{{ $rules }}" v-bind:stages="{{ $stages }}" v-bind:bukis="{{ $bukis }}">
        </insert-record>
        <edit-table v-bind:input_datas="{{ $input_datas }}" v-bind:rules="{{ $rules }}" v-bind:stages="{{ $stages }}" v-bind:bukis="{{ $bukis }}" v-bind:insert_record_data="insert_record_data">
        </edit-table> 
    </div>
@endsection

@section('vue')
<script>
Vue.config.devtools = true;

new Vue({
    el: '#app1',
    data: {
        showInsertRecord: false,
        insert_record_data: null,
    },
    mounted: function(){
    },
    methods:{
        switchInsertRecord: function() {
            this.showInsertRecord = !this.showInsertRecord;
        },
        insertRecord: function(insertRecordData){
            this.insert_record_data = insertRecordData;
        },
        /*
        submitInsertRecord: function(insertRecord){
            //console.log(insertRecord);
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
                console.log(res.data.input_data);
               // this.$set(this.testObject, 'value', 'test2-Value')
            });
        }
        */
    }
});
</script>
@endsection


