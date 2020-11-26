<template>
    <div class="filter-option">
        <form>
            <button type="button" class="btn btn-info" v-on:click="filterClick">絞り込み</button>
            <div class="border rounded">
                <span v-on:click="switchShowDateRadio">
                    <span style="display: flex">
                        <plus-minus v-bind:iconPlus="iconPlus.dateRadio"></plus-minus>
                    日付
                    </span>
                </span>
                <span v-if="showDateRadio">
                    <label>
                        <input type="radio" value="3day" v-model="filterOptions.date_radio">
                        3日分
                    </label>
                    <label>
                        <input type="radio" value="1week" v-model="filterOptions.date_radio">
                        1週間分
                    </label>
                    <label>
                        <input type="radio" value="1month" v-model="filterOptions.date_radio">
                        1カ月分
                    </label>
                    <label>
                        <input type="radio" value="1year" v-model="filterOptions.date_radio">
                        1年分
                    </label>
                    <label>
                        <input type="radio" value="allTime" v-model="filterOptions.date_radio">
                        全期間
                    </label>
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
                <span v-if="showRulesCheckbox">
                    <span v-for="rule in rules" :key="rule.id">
                        <label>
                            <input type="checkbox" v-bind:id=rule.rule_id v-bind:value=rule.rule_id v-model="filterOptions.rules_checkbox">
                            {{rule.rule_name}}
                        </label>
                    </span>
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
                <span v-if="showStagesCheckbox">
                    <span v-for="stage in stages" :key="stage.id">
                        <label>
                            <input type="checkbox" v-bind:id=stage.stage_id v-bind:value=stage.stage_id v-model="filterOptions.stages_checkbox">
                            {{stage.stage_name}}
                        </label>
                    </span>
                    <br>
                </span>
            </div>
            <div class="border rounded">
                <div v-on:click="switchShowInputDataRadio">
                    <span style="display: flex">
                        <plus-minus v-bind:iconPlus="iconPlus.inputDataRadio"></plus-minus>
                        戦績
                    </span>
                </div>
                <span v-if="showInputDataRadio">
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
                    <div v-if="!fieldsetDisable" class="border rounded">
                        <div v-on:click="switchShowBukisCheckbox">
                            <span style="display: flex">
                                <plus-minus v-bind:iconPlus="iconPlus.bukisCheckbox"></plus-minus>
                                ブキ
                            </span>
                        </div>
                        <span v-if="showBukisCheckbox">
                            <span v-for="buki in bukis" :key="buki.id">
                                <label>
                                    <input type="checkbox" v-bind:id=buki.buki_id v-bind:value=buki.buki_id v-model="filterOptions.bukis_checkbox">
                                    {{buki.buki_name}}
                                </label>
                            </span>
                        </span>
                    </div>
                    <div v-if="!fieldsetDisable" class="border rounded">
                        <div v-on:click="switchShowUdemaesPull">
                            <span style="display: flex">
                                <plus-minus v-bind:iconPlus="iconPlus.udemaesPull"></plus-minus>
                                ウデマエ
                            </span>
                        </div>
                        <span v-if="showUdemaesPull">
                            <select v-model="filterOptions.udemaes_pull" name="udemae_id">
                                <option v-for="udemae in udemaes" :key="udemae.id" v-bind:value="udemae.udemae_id" >{{ udemae.udemae_name }}</option>
                            </select>
                            <label v-if="filterOptions.udemaes_pull=='21'">XP<input v-model="filterOptions.xp_text" type="text"></label>
                            <p class="errors" v-for="error in errors.xp" :key="error.xp">{{error}}</p>
                            <span>
                                <label>
                                    <input type="radio" value=">=" v-model="filterOptions.udemae_relation_radio">
                                    以上
                                </label>
                                <label>
                                    <input type="radio" value="<=" v-model="filterOptions.udemae_relation_radio">
                                    以下
                                </label>
                            </span>
                        </span>
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
                fieldsetDisable:null,
                showDateRadio:false,
                showRulesCheckbox:false,
                showStagesCheckbox:false,
                showBukisCheckbox:false,
                showInputDataRadio:false,
                showUdemaesPull:false,
                errors:{
                    xp:[]
                },
                error:false,
                iconPlus:{
                    dateRadio:true,
                    rulesCheckbox:true,
                    stagesCheckbox:true,
                    inputDataRadio:true,
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
            switchShowDateRadio:function(){
                this.showDateRadio = !this.showDateRadio;
                this.iconPlus.dateRadio = !this.iconPlus.dateRadio;
            },
            switchShowRulesCheckbox:function(){
                this.showRulesCheckbox = !this.showRulesCheckbox;
                this.iconPlus.rulesCheckbox = !this.iconPlus.rulesCheckbox;
            },
            switchShowStagesCheckbox:function(){
                this.showStagesCheckbox = !this.showStagesCheckbox;
                this.iconPlus.stagesCheckbox = !this.iconPlus.stagesCheckbox;
            },
            switchShowInputDataRadio:function(){
                this.showInputDataRadio = !this.showInputDataRadio;
                this.iconPlus.inputDataRadio = !this.iconPlus.inputDataRadio;
            },
            switchShowBukisCheckbox:function(){
                this.showBukisCheckbox = !this.showBukisCheckbox;
                this.iconPlus.bukisCheckbox = !this.iconPlus.bukisCheckbox;
            },
            switchShowUdemaesPull:function(){
                this.showUdemaesPull = !this.showUdemaesPull;
                this.iconPlus.udemaesPull = !this.iconPlus.udemaesPull;
            },
            validator: function(){
                let xp = [];
                let message = '';
                this.error = false;
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
        watch:{
            filterOptions:{
                handler: function(value){
                    if(value.input_data_radio == "inserted"){
                        this.fieldsetDisable=false;
                    }else{
                        this.fieldsetDisable=true;
                    }
                },
                deep: true
            }
        }
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