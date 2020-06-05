<template> 
    <div>
        <table class="table table-striped table-bordered">
            <tr>
                <th>ルール</th>
                <th>ステージ1</th>
                <th>ステージ2</th>
                <th>ブキ</th>
                <th>XP</th>
                <th></th>
                <th></th>
            </tr>
            <tr v-for="input_data, key in input_datas">
                <td>{{ input_data.rule.rule_name }}</td>
                <td>{{ input_data.stage1.stage_name }}</td>
                <td>{{ input_data.stage2.stage_name }}</td>
                <td>{{ input_data.buki.buki_name }}</td>
                <td>{{ input_data.xp }}</td>
                <td><button type="button" class="editBtn btn btn-info" @click.prevent="switchEditRow(input_data)">編集</button></td>
                <td><button type="button" class="deleteBtn btn btn-info">削除</button></td>
            </tr>
        </table>
        <edit-record v-show="showEditRecord" v-on:from-child="switchEditRow()" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis" v-bind:input_data="input_data">
        </edit-record>
    </div>
</template>

<script>
    export default {
        props:["input_datas", "rules", "stages", "bukis"],
        data () {
            return {
                showEditRecord: false,
                input_data: null
            }
        },
        methods: {
             switchEditRow: function(input_data) {
                this.showEditRecord = !this.showEditRecord
                this.input_data = input_data
             }
        }
    }
</script>
