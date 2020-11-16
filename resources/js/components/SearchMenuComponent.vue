<template>
    <div class="filter-option">
        <form>
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
        props:["rules", "stages", "bukis", "filterOptions"],
        data:function(){
            return{
                input_data_id:null,
                rule_id:null,
                stage1_id:null,
                stage2_id:null,
                buki_id:null,
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
