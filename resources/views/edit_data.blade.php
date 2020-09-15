@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')

@section('h1', 'データ編集')

@section('content')
    <div id="app1">
        <button v-on:click="switchInsertRecord()">データの追加</button>
        <insert-record v-if="showInsertRecord" v-on:click-cancel-insert-btn="switchInsertRecord" v-on:click-insert-btn="insertRecord" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis">
        </insert-record>
        <edit-table v-bind:input_datas="input_datas" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis" v-on:click-update-btn="updateRecord" v-on:click-delete-btn="deleteRecord">
        </edit-table>
        <pagination v-bind:pagination_data="paginationData" v-on:click-page-number="movePage"></pagination>
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
        paginationData:{
            current_page: null,
            first_page_url: null,
            from: null,
            last_page: null,
            last_page_url: null,
            next_page_url: null,
            path: null,
            per_page: null,
            prev_page_url: null,
            to: null,
            total: null,
        }
    },
    mounted(){
        this.getParentTables();
        this.getInputDatas(1);
        //this.getStageInfo();
    },
    methods:{
        getParentTables:function(){
            const func = async ()=>{
                try{
                    let res = await axios.get('get_parent_tables');
                    console.log(res);
                    const tables = res.data.db_data;
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
        getInputDatas: function(targetPage){
            const func = async ()=>{
                try{
                    let res = await axios.get('get_input_datas', {
                        params:{
                            page:targetPage
                        }
                    });
                    console.log(res);
                    let input_datas = res.data.db_data
                    this.input_datas = input_datas.data;
                    this.paginationData.current_page = input_datas.current_page;
                    this.paginationData.first_page_url = input_datas.first_page_url;
                    this.paginationData.from = input_datas.from;
                    this.paginationData.last_page = input_datas.last_page;
                    this.paginationData.last_page_url = input_datas.last_page_url;
                    this.paginationData.next_page_url = input_datas.next_page_url;
                    this.paginationData.path = input_datas.path;
                    this.paginationData.per_page = input_datas.per_page;
                    this.paginationData.prev_page_url = input_datas.prev_page_url;
                    this.paginationData.to = input_datas.to;
                    this.paginationData.total = input_datas.total;
                }
                catch (error){
                    console.log(error.response.data);
                    alert("サーバーエラーが発生しました。");
                }
            }
            func();
        },
        getStageInfo: function(){
            const func = async ()=>{
                try{
                    let res = await axios.get('get_stage_info', {
                    });
                    console.log(res);
                }
                catch (error){
                    console.log(error.response.data);
                    alert("サーバーエラーが発生しました。");
                }
            }
            func();
        },
        movePage: function(pageNumber){
            this.getInputDatas(pageNumber);
        },
        switchInsertRecord: function() {
            this.showInsertRecord = !this.showInsertRecord;
        },
        insertRecord: function(insertRecordData){
            this.input_datas.push(insertRecordData);
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


