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
            <tr v-for="input_data in input_datas" :key="input_data.input_data_id">
                <td>{{ input_data.rule.rule_name }}</td>
                <td>{{ input_data.stage1.stage_name }}</td>
                <td>{{ input_data.stage2.stage_name }}</td>
                <td>{{ input_data.buki.buki_name }}</td>
                <td>{{ input_data.xp }}</td>
                <td><button type="button" class="editBtn btn btn-info" @click.prevent="switchEditRecord(input_data)">編集</button></td>
                <td><button type="button" class="deleteBtn btn btn-info" @click.prevent="deleteRecord(input_data.input_data_id)">削除</button></td>
            </tr>
        </table>
        <edit-record v-if="showEditRecord" v-on:click-update-btn="updateRecord" v-on:click-cancel-edit-btn="switchEditRecord" v-bind:rules="rules" v-bind:stages="stages" v-bind:bukis="bukis" v-bind:editData="editData">
        </edit-record> 
    </div>
</template>

<script>
    export default {
        props:["input_datas", "rules", "stages", "bukis", "insert_record_data"],
        data: function(){
            return{
                showEditRecord: false,
                editData: null,
            }
        },
        methods: {
             switchEditRecord: function(input_data) {
                this.showEditRecord = !this.showEditRecord;
                this.editData = input_data;
             },
            deleteRecord: function(delete_input_data_id) {
                let postData = {
                    'input_data_id':delete_input_data_id
                }
                const func = async ()=>{
                    try{
                        let res = await axios.post('delete_record', postData);
                        this.$emit('click-delete-btn', res.data.input_data_id);
                    }
                    catch (error){
                        console.log(error.response.data);
                        alert("サーバーエラーが発生しました。");
                    }
                }
                func();
            },
            updateRecord: function(updateRecordData){
                this.$emit('click-update-btn', updateRecordData);
            },
        },
        watch:{
            insert_record_data:{
                handler: function () {
                    this.input_datas.push(this.insert_record_data);
                },
                deep: true
            }
        }
    }
</script>