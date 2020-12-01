<template>
    <div class="filter-option">
        <form>
            <button type="button" class="btn btn-info" v-on:click="filterClick">絞り込み</button>
            <div class="border rounded">
                <span v-on:click="switchShowDateCheckbox">
                    <span style="display: flex">
                        <plus-minus v-bind:iconPlus="iconPlus.dateCheckbox"></plus-minus>
                    日付
                    </span>
                </span>
                <span v-show="showDateCheckbox">
                    <label>
                        <input type="checkbox" value="future" v-model="filterOptions.date_checkbox">
                        未来のガチマッチ
                    </label>
                    <label>
                        <input type="checkbox" value="current" v-model="filterOptions.date_checkbox">
                        現在のガチマッチ
                    </label>
                    <label>
                        <input type="checkbox" value="past" v-model="filterOptions.date_checkbox">
                        過去のガチマッチ
                    </label>
                    <p class="errors" v-for="error in errors.date" :key="error.date">{{error}}</p>
                    <br>
                </span>
            </div>
            <div class="border rounded">
                <div v-on:click="switchShowRulesCheckbox">
                    <span style="display: flex">
                        <plus-minus v-bind:iconPlus="iconPlus.rulesCheckbox"></plus-minus>
                        ルール
                    </span>
                </div>
                <span v-show="showRulesCheckbox">
                    <span v-for="rule in rules" :key="rule.id">
                        <label>
                            <input type="checkbox" v-bind:id=rule.rule_id v-bind:value=rule.rule_id v-model="filterOptions.rules_checkbox">
                            {{rule.rule_name}}
                        </label>
                    </span>
                    <p class="errors" v-for="error in errors.rules" :key="error.rules">{{error}}</p>
                    <br>
                </span>
            </div>
            <div class="border rounded">
                <div v-on:click="switchShowStagesCheckbox">
                    <span style="display: flex">
                        <plus-minus v-bind:iconPlus="iconPlus.stagesCheckbox"></plus-minus>
                        ステージ
                    </span>
                </div>
                <span v-show="showStagesCheckbox">
                    <button type="button" class="btn btn-info" v-on:click="allCheckStages">ALL ON/OFF</button>
                    <p class="errors" v-for="error in errors.stages" :key="error.stages">{{error}}</p>
                    <span v-for="stage in stages" :key="stage.id">
                        <label>
                            <input type="checkbox" v-bind:id=stage.stage_id v-bind:value=stage.stage_id v-model="filterOptions.stages_checkbox">
                            {{stage.stage_name}}
                        </label>
                    </span>
                    <button type="button" class="btn btn-info" v-on:click="allCheckStages">ALL ON/OFF</button>
                    <p class="errors" v-for="error in errors.stages" :key="error.stages">{{error}}</p>
                    <br>
                </span>
            </div>
            <div class="border rounded">
                <div v-on:click="switchShowInputDataArea">
                    <span style="display: flex">
                        <plus-minus v-bind:iconPlus="iconPlus.inputDataArea"></plus-minus>
                        戦績
                    </span>
                </div>
                <span v-show="showInputDataArea">
                    <label>
                        <input type="radio" value="all" v-model="filterOptions.input_data_radio">
                        入力済/未入力
                    </label>
                    <label>
                        <input type="radio" value="inserted" v-model="filterOptions.input_data_radio">
                        入力済
                    </label>
                    <label>
                        <input type="radio" value="uninserted" v-model="filterOptions.input_data_radio">
                        未入力
                    </label>
                    <div class="container">
                        <div v-show="filterOptions.input_data_radio=='inserted'" class="border rounded col-md-offset-1">
                            <div v-on:click="switchShowBukisCheckbox">
                                <span style="display: flex">
                                    <plus-minus v-bind:iconPlus="iconPlus.bukisCheckbox"></plus-minus>
                                    ブキ
                                </span>
                            </div>
                            <span v-show="showBukisCheckbox">
                                <p class="errors" v-for="error in errors.bukis" :key="error.bukis">{{error}}</p>
                                <button type="button" class="btn btn-info" v-on:click="allCheckBukis">ALL ON/OFF</button>
                                <span v-for="buki in bukis" :key="buki.id">
                                    <label>
                                        <input type="checkbox" v-bind:id=buki.buki_id v-bind:value=buki.buki_id v-model="filterOptions.bukis_checkbox">
                                        {{buki.buki_name}}
                                    </label>
                                </span>
                                <button type="button" class="btn btn-info" v-on:click="allCheckBukis">ALL ON/OFF</button>
                                <p class="errors" v-for="error in errors.bukis" :key="error.bukis">{{error}}</p>
                            </span>
                        </div>
                        <div v-show="filterOptions.input_data_radio=='inserted'" class="border rounded">
                            <div v-on:click="switchShowUdemaesPull">
                                <span style="display: flex">
                                    <plus-minus v-bind:iconPlus="iconPlus.udemaesPull"></plus-minus>
                                    ウデマエ
                                </span>
                            </div>
                            <div v-show="showUdemaesPull">
                                <select v-model="filterOptions.udemaes_pull" name="udemae_id">
                                    <option v-for="udemae in udemaes" :key="udemae.id" v-bind:value="udemae.udemae_id" >{{ udemae.udemae_name }}</option>
                                </select>
                                <div><label v-show="filterOptions.udemaes_pull=='21'">XP<input v-model="filterOptions.xp_text" type="text"></label></div>
                                <p class="errors" v-for="error in errors.xp" :key="error.xp">{{error}}</p>
                                <div>
                                    <label>
                                        <input type="radio" value=">=" v-model="filterOptions.udemae_relation_radio">
                                        以上
                                    </label>
                                    <label>
                                        <input type="radio" value="<=" v-model="filterOptions.udemae_relation_radio">
                                        以下
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </span>
            </div>
            <button type="button" class="btn btn-info" v-on:click="filterClick">絞り込み</button>
        </form>
    </div>
</template>

<script>
    export default {
        props:["rules", "stages", "bukis", "udemaes", "filterOptions"],
        data:function(){
            return{
                showDateCheckbox:false,
                showRulesCheckbox:false,
                showStagesCheckbox:false,
                showInputDataArea:false,
                showBukisCheckbox:false,
                showUdemaesPull:false,
                allCheckStagesFlag:false,
                allCheckBukisFlag:false,
                errors:{
                    date:[],
                    rules:[],
                    stages:[],
                    bukis:[],
                    xp:[],
                },
                error:false,
                iconPlus:{
                    dateCheckbox:true,
                    rulesCheckbox:true,
                    stagesCheckbox:true,
                    inputDataArea:true,
                    bukisCheckbox:true,
                    udemaesPull:true,
                },
            }
        },
        methods:{
            filterClick:function(){
                this.validator();
                if(!this.error){
                    this.$emit('click-filter-btn');
                }
            },
            switchShowDateCheckbox:function(){
                this.showDateCheckbox = !this.showDateCheckbox;
                this.iconPlus.dateCheckbox = !this.iconPlus.dateCheckbox;
            },
            switchShowRulesCheckbox:function(){
                this.showRulesCheckbox = !this.showRulesCheckbox;
                this.iconPlus.rulesCheckbox = !this.iconPlus.rulesCheckbox;
            },
            switchShowStagesCheckbox:function(){
                this.showStagesCheckbox = !this.showStagesCheckbox;
                this.iconPlus.stagesCheckbox = !this.iconPlus.stagesCheckbox;
            },
            switchShowInputDataArea:function(){
                this.showInputDataArea = !this.showInputDataArea;
                this.iconPlus.inputDataArea = !this.iconPlus.inputDataArea;
            },
            switchShowBukisCheckbox:function(){
                this.showBukisCheckbox = !this.showBukisCheckbox;
                this.iconPlus.bukisCheckbox = !this.iconPlus.bukisCheckbox;
            },
            switchShowUdemaesPull:function(){
                this.showUdemaesPull = !this.showUdemaesPull;
                this.iconPlus.udemaesPull = !this.iconPlus.udemaesPull;
            },
            allCheckStages:function(){
                this.filterOptions.stages_checkbox = [];
                if(this.allCheckStagesFlag){
                    for(let i=0; i<this.stages.length; i++){
                        this.filterOptions.stages_checkbox.push(this.stages[i].stage_id);
                    }
                }
                this.allCheckStagesFlag = !this.allCheckStagesFlag;
            },
            allCheckBukis:function(){
                this.filterOptions.bukis_checkbox = [];
                if(this.allCheckBukisFlag){
                    for(let i=0; i<this.bukis.length; i++){
                        this.filterOptions.bukis_checkbox.push(this.bukis[i].buki_id);
                    }
                }
                this.allCheckBukisFlag = !this.allCheckBukisFlag;
            },
            validator: function(){
                let date = [];
                let rules = [];
                let stages = [];
                let bukis = [];
                let xp = [];
                let message = '';
                this.error = false;
                //日付チェックボックスが空の場合
                if(this.filterOptions.date_checkbox.length==0){
                    if(!this.showDateCheckbox){
                        this.switchShowDateCheckbox();
                    }
                    message = '1つ以上選択してください。';
                    date.push(message);
                    this.error = true;
                }
                this.errors.date = date;
                //ルールチェックボックスが空の場合
                if(this.filterOptions.rules_checkbox.length==0){
                    if(!this.showRulesCheckbox){
                        this.switchShowRulesCheckbox();
                    }
                    message = '1つ以上選択してください。';
                    rules.push(message);
                    this.error = true;
                }
                this.errors.rules = rules;
                //ステージチェックボックスが空の場合
                if(this.filterOptions.stages_checkbox.length==0){
                    if(!this.showStagesCheckbox){
                        this.switchShowStagesCheckbox();
                    }
                    message = '1つ以上選択してください。';
                    stages.push(message);
                    this.error = true;
                }
                this.errors.stages = stages;
                //戦績あり かつ ブキチェックボックスが空の場合
                if(this.filterOptions.input_data_radio=="inserted" && this.filterOptions.bukis_checkbox.length==0){
                    if(!this.showInputDataArea){
                        this.switchShowInputDataArea();
                    }
                    if(!this.showBukisCheckbox){
                        this.switchShowBukisCheckbox();
                    }
                    message = '1つ以上選択してください。';
                    bukis.push(message);
                    this.error = true;
                }
                this.errors.bukis = bukis;
                //ウデマエXの場合
                if(this.filterOptions.udemaes_pull == '21'){
                    if(!(this.filterOptions.xp_text>=0 && this.filterOptions.xp_text<=9999) && this.filterOptions.xp_text!=null ){
                        message = 'XPは0～9999の半角数字で入力してください。';
                        xp.push(message);
                        this.error = true;
                    }
                }
                this.errors.xp = xp;
            },
        },
    }   
</script>
<style>
    legend {
        display: initial;
        width: initial;
        max-width: initial;
        padding: initial;
        margin-bottom: initial;
        font-size: initial;
        line-height: initial;
        color: initial;
        white-space: initial;
    }
</style>