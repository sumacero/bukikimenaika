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
            <tr v-for="input_data in tableData" :key="input_data.input_data_id">
                <td>{{ input_data.rule.rule_name }}</td>
                <td>{{ input_data.stage1.stage_name }}</td>
                <td>{{ input_data.stage2.stage_name }}</td>
                <td>{{ input_data.buki.buki_name }}</td>
                <td>{{ input_data.xp }}</td>
                <td><button type="button" class="editBtn btn btn-info" @click.prevent="switchEditRecord(input_data)">編集</button></td>
                <td><button type="button" class="deleteBtn btn btn-info" @click.prevent="deleteRecord(input_data.input_data_id)">削除</button></td>
            </tr>
        </table>
        <edit-record v-if="showEditRecord" v-on:click-edit-btn="switchEditRecord()" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis" v-bind:editData="editData">
        </edit-record>
    </div>
</template>

<script>
    export default {
        //props:["input_datas", "rules", "stages", "bukis"],
        props:{
            input_datas:{
                type:Array,
                required: true,
            },
            rules:{
                type:Array,
                required: true,
            },
            stages:{
                type:Array,
                required: true,
            },
            bukis:{
                type:Array,
                required: true,
            },
            insert_record_data:{
                type:Object,
            },
        },
        data: function(){
            return{
                showEditRecord: false,
                tableData: this.input_datas,
                editData: null,
            }
        },
        methods: {
             switchEditRecord: function(input_data) {
                this.showEditRecord = !this.showEditRecord;
                this.editData = input_data;
             },
            deleteRecord: function(key) {
                this.tableData = this.tableData.filter(data => data.input_data_id !== key);
                let postData = {
                    'delete_key':key
                }
                axios.post('/api/delete_record/', postData).then(res => {
                    // テストのため返り値をコンソールに表示
                    console.log(res.data);
                    // this.$set(this.testObject, 'value', 'test2-Value')
                });
             },
        },
        watch:{
            insert_record_data:{
                handler: function () {
                    this.tableData.push(this.insert_record_data);
                },
                deep: true
            }
        }
    }
</script>