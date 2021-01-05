@extends('layouts.common_layout')



@section('title', 'ブキキメナイカ')

@section('h1', 'ガチマッチ情報')

@section('content')
    <div id="app1">
        <div v-on:click="switchShowHowToUse">
            <div align="right">使い方[Click]</div>
            <how-to-use v-if="showHowToUse">
            </how-to-use>
        </div>
        <button v-on:click=switchShowSearchMenu class="btn btn-outline-primary btn-sm">絞り込み</button>
        <search-menu v-show="showSearchMenu" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis" v-bind:udemaes="udemaes" v-bind:filter-options="filterOptions" v-on:click-filter-btn="filterRecord" v-on:close-search-menu="showSearchMenu = false">
        </search-menu>    
        <pagination v-bind:pagination-data="paginationData" v-on:click-page-number="movePage"></pagination>
        <div>@{{ paginationData.total }}件</div>
        <gachi-list v-bind:input_datas="input_datas" v-bind:gachis="gachis" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis" v-bind:udemaes="udemaes" v-bind:osusume_buki_info="osusumeBukiInfo" v-on:click-insert-btn="insertRecord" v-on:click-update-btn="updateRecord" v-on:click-delete-btn="deleteRecord">
        </gachi-list>
        <pagination v-bind:pagination-data="paginationData" v-on:click-page-number="movePage"></pagination>
    </div>
@endsection

@section('vue')
<script>
Vue.config.devtools = true;
new Vue({
    el: '#app1',
    data: {
        initFlag: true,
        input_datas: null,
        gachis:null,
        rules:null,
        stages:null,
        bukis:null,
        udemaes:null,
        osusumeBukiInfo:{
            targetGachiIds:[],
            osusumeBukisArray:[],
        },
        showInsertRecord: false,
        showHowToUse: false,
        showSearchMenu: false,
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
            date_checkbox:["future","current","past"],
            rules_checkbox:[],
            stages_checkbox:[],
            bukis_checkbox:[],
            input_data_radio:"all",
            udemaes_pull:null,
            xp_text:null,
            udemae_relation_radio:">=",
        }
    },
    mounted(){
        this.getParentTables();
        this.getGachis(1);
        this.getOsusumeBukis();
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
                    //udemaes
                    this.udemaes = tables.udemaes;
                    //input_datas
                    this.input_datas = tables.input_datas;
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
                            init_flag:this.initFlag,
                            page:targetPage,
                            date_checkbox:this.filterOptions.date_checkbox,
                            rules_checkbox:this.filterOptions.rules_checkbox,
                            stages_checkbox:this.filterOptions.stages_checkbox,
                            bukis_checkbox:this.filterOptions.bukis_checkbox,
                            input_data_radio:this.filterOptions.input_data_radio,
                            udemaes_pull:this.filterOptions.udemaes_pull,
                            xp_text:this.filterOptions.xp_text,
                            udemae_relation_radio:this.filterOptions.udemae_relation_radio,
                        }
                    });
                    /*
                    console.log("送信データ(filterData)↓");
                    console.log(this.filterOptions);
                    console.log("返答(gachis)↓");
                    console.log(res);
                    */
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
        getOsusumeBukis(){
            const func = async ()=>{
                try{                    
                    let res = await axios.get('get_osusume_bukis');
                    console.log("オススメブキ↓");
                    console.log(res);
                    this.osusumeBukiInfo = res.data.osusumeBukiInfo;
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
        switchShowHowToUse: function() {
            this.showHowToUse = !this.showHowToUse;
        },
        switchShowSearchMenu: function() {
            this.showSearchMenu = true;
        },
        insertRecord: function(insertRecordData){
            this.input_datas.push(insertRecordData);
            this.getOsusumeBukis();
        },
        updateRecord: function(updateRecordData){
            for(let i = 0; i<this.input_datas.length; i++){
                if(this.input_datas[i].input_data_id === updateRecordData.input_data_id){
                    this.input_datas.splice(i, 1, updateRecordData); // i番目から１つ削除し、データを追加
                }       
            }    
            this.getOsusumeBukis();
        },
        deleteRecord: function(deleteRecordDataId){
            this.input_datas = this.input_datas.filter(data => data.input_data_id !== deleteRecordDataId);
            this.getOsusumeBukis();
        },
        filterRecord: function(){
            this.initFlag = false;
            this.getGachis(1);
        }
    }
});
</script>
@endsection


