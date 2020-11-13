<template>
    <div class="filter-option">
        <form>
            <div>
            <label>ルール</label><br>
            <span v-for="rule in rules" :key="rule.id">
                <label>
                    <input type="checkbox" v-bind:id=rule.rule_id v-bind:value=rule.rule_id v-model="filterOptions.rules_checkbox">
                    {{rule.rule_name}}
                </label>
            </span>
            </div>
            <div>
            <label>ステージ</label><br>
            <span v-for="stage in stages" :key="stage.id">
                <label>
                    <input type="checkbox" v-bind:id=stage.stage_id v-bind:value=stage.stage_id v-model="filterOptions.stages_checkbox">
                    {{stage.stage_name}}
                </label>
            </span>
            </div>
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