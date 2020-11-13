<template> 
    <div v-bind:class="customizedClass" style="border: 2px solid">       
        <div style="border: 1px solid">
            {{ gachiState }}
            <div>期間：{{ gachi.start_t }}～{{ gachi.end_t }}</div>
            <div>ルール：{{ gachi.rule.rule_name }}</div>
            <span style="display: flex">
            <div class="col-md-3">ステージ1：{{ gachi.stage1.stage_name }}<br>
                <img v-bind:src="'images/'+gachi.stage1.stage_name+'.png'" v-bind:alt="gachi.stage1.stage_name+'.png'" width="200" height="100">
            </div>
            <div class="col-md-3">ステージ2：{{ gachi.stage2.stage_name }}<br>
                <img v-bind:src="'images/'+gachi.stage2.stage_name+'.png'" v-bind:alt="gachi.stage2.stage_name+'.png'" width="200" height="100">
            </div>
            </span>
        </div>
         
        <div style="border: 1px solid">
            <div v-if="input_data">
            あなたの記録
                <div>ブキ：{{ input_data.buki.buki_name }}</div>
                <div>ウデマエ：{{ input_data.udemae.udemae_name }}</div>
                <div>XP：{{ input_data.xp }}</div>
            </div>
            <button type="button" class="editBtn btn btn-info" @click.prevent="switchEditRecord(input_data)">編集</button>
            <button type="button" class="deleteBtn btn btn-info" @click.prevent="deleteRecord(input_data.input_data_id)">削除</button>
        </div>
    </div>
</template>

<script>
    export default {
        props:["gachi", "input_data", "rules", "stages", "bukis", "udemaes"],
        data: function(){
            return{
                showEditRecord: false,
                gachi_id: this.gachi.gachi_id,
                nowTimeStamp: null,
                gachiStartTimeStamp: null,
                gachiEndTimeStamp: null,
                gachiState: null,
                customizedClass: null,
            }
        },
        mounted(){
            this.nowTimeStamp = new Date();
            this.gachiStartTimeStamp = new Date(this.gachi.start_t);
            this.gachiEndTimeStamp = new Date(this.gachi.end_t);
            if(this.nowTimeStamp.getTime() > this.gachiEndTimeStamp.getTime()){
                this.gachiState = "過去のガチマッチ";
            }else if(this.nowTimeStamp.getTime() > this.gachiStartTimeStamp){
                this.gachiState = "現在のガチマッチ";
            }else{
                this.gachiState = "未来のガチマッチ";
            }
        },
        methods: {
            switchEditRecord: function(input_data) {
                this.$emit('click-show-edit-btn', input_data, this.gachi_id);
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
        },
    }
</script>

<!--
<style lang="scss" scoped>
.active {
  background-color: #000000;
}
</style>
-->