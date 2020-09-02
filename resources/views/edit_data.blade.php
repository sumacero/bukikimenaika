@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')

@section('h1', 'データ編集')

@section('content')
    <div id="app1">
        <button v-on:click="switchInsertRecord()">データの追加</button>
        <insert-record v-if="showInsertRecord" v-on:click-cancel-insert-btn="switchInsertRecord" v-on:click-insert-btn="insertRecord" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis">
        </insert-record>
        <edit-table v-bind:input_datas="input_datas" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis" v-bind:insert_record_data="insert_record_data" v-on:click-update-btn="updateRecord" v-on:click-delete-btn="deleteRecord">
        </edit-table> 
    </div>
@endsection

@section('vue')
<script>
Vue.config.devtools = true;

new Vue({
    el: '#app1',
    data: {
        input_datas: null,
        rules:null,
        stages:null,
        bukis:null,
        showInsertRecord: false,
        insert_record_data: null,
    },
    mounted(){
        const func = async ()=>{
            try{
                let res = await axios.get('get_data');
                const tables = res.data.db_data;
                this.input_datas = tables.input_datas;
                this.rules = tables.rules;
                this.stages = tables.stages;
                this.bukis = tables.bukis;
            }
            catch (error){
                console.log(error.response.data);
                alert("サーバーエラーが発生しました。");
            }
        }
        func();
    },
    methods:{
        switchInsertRecord: function() {
            this.showInsertRecord = !this.showInsertRecord;
        },
        insertRecord: function(insertRecordData){
            this.insert_record_data = insertRecordData;
        },
        updateRecord: function(updateRecordData){
            for(let i = 0; i<this.input_datas.length; i++){
                if(this.input_datas[i].input_data_id === updateRecordData.input_data_id){
                    this.input_datas.splice(i, 1, updateRecordData); // i番目から１つ削除し、データを追加
                }       
            }    
        },
        deleteRecord: function(deleteRecordDataId){
            this.input_datas = this.input_datas.filter(data => data.input_data_id !== deleteRecordDataId);
        }
    }
});
</script>
@endsection


