<template>
    <div class="filter-option">
        <form>
            <button type="button" class="btn btn-info" v-on:click="filterClick">絞り込み</button>
            <fieldset style="border: 1px solid #000000; padding: 10px;">
                <legend>日時</legend>
                <span>
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
                </span>
            </fieldset>
            <fieldset style="border: 1px solid #000000; padding: 10px;">
                <legend>ルール</legend>
                <span v-for="rule in rules" :key="rule.id">
                    <label>
                        <input type="checkbox" v-bind:id=rule.rule_id v-bind:value=rule.rule_id v-model="filterOptions.rules_checkbox">
                        {{rule.rule_name}}
                    </label>
                </span>
            </fieldset>
            <fieldset style="border: 1px solid #000000; padding: 10px;">
                <legend>ステージ</legend>
                <span v-for="stage in stages" :key="stage.id">
                    <label>
                        <input type="checkbox" v-bind:id=stage.stage_id v-bind:value=stage.stage_id v-model="filterOptions.stages_checkbox">
                        {{stage.stage_name}}
                    </label>
                </span>
            </fieldset>
            <fieldset style="border: 1px solid #000000; padding: 10px;">
                <legend>あなたの記録</legend>
                <span>
                    <label>
                        <input type="checkbox">
                        入力済み
                    </label>
                    <label>
                        <input type="checkbox">
                        未入力
                    </label>
                </span>
                <fieldset style="border: 1px solid #000000; padding: 10px;">
                    <legend>ブキ</legend>
                    <span v-for="buki in bukis" :key="buki.id">
                        <label>
                            <input type="checkbox" v-bind:id=buki.buki_id v-bind:value=buki.buki_id v-model="filterOptions.bukis_checkbox">
                            {{buki.buki_name}}
                        </label>
                    </span>
                </fieldset>
                <fieldset style="border: 1px solid #000000; padding: 10px;">
                    <legend>ウデマエ</legend>
                    <select v-model="udemae_id" name="udemae_id">
                        <option v-for="udemae in udemaes" :key="udemae.id" v-bind:value="udemae.udemae_id" >{{ udemae.udemae_name }}</option>
                    </select>
                    <label for="xp">XP<input v-model="xp" type="text" name="xp"></label>
                    <span>
                        <label>
                            <input type="radio" name="udemae_radio">
                            以上
                        </label>
                        <label>
                            <input type="radio" name="udemae_radio">
                            以下
                        </label>
                    </span>
                </fieldset>
            </fieldset>

            <!--
            <div>
            <label>ブキ</label><br>
            <span v-for="buki in bukis" :key="buki.id">
                <label>
                    <input type="checkbox" v-bind:id=buki.buki_id v-bind:value=buki.buki_id v-model="filterOptions.bukis_checkbox">
                    {{buki.buki_name}}
                </label>
            </span>
            </div>
            -->
            <button type="button" class="btn btn-info" v-on:click="filterClick">絞り込み</button>
        </form>
    </div>
</template>

<script>
    export default {
        props:["rules", "stages", "bukis", "udemaes", "filterOptions"],
        data:function(){
            return{
                input_data_id:null,
                rule_id:null,
                stage1_id:null,
                stage2_id:null,
                buki_id:null,
                udemae_id:null,
                xp:null,
                errors:{
                    rule:[],
                    stage1:[],
                    stage2:[],
                    buki:[],
                    xp:[]
                },
                error:false,
            }
        },
        methods:{
            filterClick:function(){
                this.$emit('click-filter-btn');
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
