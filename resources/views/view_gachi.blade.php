@extends('layouts.common_layout')

@section('title', 'ブキキメナイカ')

@section('h1', 'ガチマッチ情報')

@section('content')
    <div id="app1">
        <span style="display: flex">
            <div class="col-md-2">
                <search-menu v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis" v-bind:filter-options="filterOptions" v-on:click-filter-btn="filterRecord">
                </search-menu>
            </div>
            <div class="col-md-10">
                <div>@{{ paginationData.total }}件</div>
                <gachi-list v-bind:input_datas="input_datas" v-bind:gachis="gachis" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis" v-bind:udemaes="udemaes" v-on:click-insert-btn="insertRecord" v-on:click-update-btn="updateRecord" v-on:click-delete-btn="deleteRecord">
                </gachi-list>
                <pagination v-bind:pagination-data="paginationData" v-on:click-page-number="movePage"></pagination>
            </div>
        </span>
    </div>
@endsection

@section('vue')
<script>
Vue.config.devtools = true;
new Vue({
    el: '#app1',
    data: {
        input_datas: null,
        gachis:null,
        rules:null,
        stages:null,
        bukis:null,
        udemaes:null,
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
        },
        filterOptions:{
            rules_checkbox:[],
            stages_checkbox:[],
            bukis_checkbox:[],
            xp_min:null,
            xp_max:null,
        }
    },
    mounted(){
        this.getParentTables();
        this.getGachis(1);
    },
    methods:{
        getParentTables:function(){
            const func = async ()=>{
                try{
                    let res = await axios.get('get_parent_tables');
                    const tables = res.data.db_data;
                    //rules
                    this.rules = tables.rules;
                    var temp=[];
                    this.rules.forEach(function(rule){
                        temp.push(rule.rule_id);
                    });
                    this.filterOptions.rules_checkbox = temp.slice(0, temp.length);
                    //stages
                    this.stages = tables.stages;
                    temp=[];
                    this.stages.forEach(function(stage){
                        temp.push(stage.stage_id);
                    });
                    this.filterOptions.stages_checkbox = temp.slice(0, temp.length);
                    //bukis
                    this.bukis = tables.bukis;
                    temp=[];
                    this.bukis.forEach(function(buki){
                        temp.push(buki.buki_id);
                    });
                    this.filterOptions.bukis_checkbox = temp.slice(0, temp.length);
                    //input_datas
                    this.input_datas = tables.input_datas;
                    //udemaes
                    this.udemaes = tables.udemaes;
                }
                catch (error){
                    console.log(error.response);
                    alert("サーバーエラーが発生しました。");
                }
            }
            func();
        },
        getGachis: function(targetPage){
            const func = async ()=>{
                try{                    
                    let res = await axios.get('get_gachis', {
                        params:{
                            page:targetPage,
                            rules_checkbox:this.filterOptions.rules_checkbox,
                            stages_checkbox:this.filterOptions.stages_checkbox,
                            bukis_checkbox:this.filterOptions.bukis_checkbox,
                        }
                    });
                    console.log("送信データ↓");
                    console.log(this.filterOptions);
                    console.log("返答↓");
                    console.log(res);
                    let gachis = res.data.db_data
                    this.gachis = gachis.data;
                    this.paginationData.current_page = gachis.current_page;
                    this.paginationData.first_page_url = gachis.first_page_url;
                    this.paginationData.from = gachis.from;
                    this.paginationData.last_page = gachis.last_page;
                    this.paginationData.last_page_url = gachis.last_page_url;
                    this.paginationData.next_page_url = gachis.next_page_url;
                    this.paginationData.path = gachis.path;
                    this.paginationData.per_page = gachis.per_page;
                    this.paginationData.prev_page_url = gachis.prev_page_url;
                    this.paginationData.total = gachis.total;
                    if(!this.paginationData.total){
                        this.paginationData.total = 0;
                    }
                }
                catch (error){
                    console.log(error.response.data);
                    alert("サーバーエラーが発生しました。");
                }
            }
            func();
        },
        movePage: function(pageNumber){
            this.getGachis(pageNumber);
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
        },
        filterRecord: function(){
            console.log(this.filterOptions);
            this.getGachis(1);
        }
    }
});
</script>
@endsection


