<template> 
    <fieldset v-bind:class="customizedClass" style="border: 1px solid #000000; padding: 10px;">
        <legend>{{ formatTimeStamp(gachi.start_t) }}～{{ formatTimeStamp(gachi.end_t) }}　◆{{gachiStateMsg}}</legend>
        <fieldset style="border: 1px solid #000000; padding: 10px;">
            <div class="col-md-3">ルール：{{ gachi.rule.rule_name }}</div>
            <span style="display: flex">
            <div class="col-md-3">ステージ1：{{ gachi.stage1.stage_name }}<br>
                <img v-bind:src="'images/'+gachi.stage1.stage_name+'.png'" v-bind:alt="gachi.stage1.stage_name+'.png'" width="200" height="100">
            </div>
            <div class="col-md-3">ステージ2：{{ gachi.stage2.stage_name }}<br>
                <img v-bind:src="'images/'+gachi.stage2.stage_name+'.png'" v-bind:alt="gachi.stage2.stage_name+'.png'" width="200" height="100">
            </div>
            </span>
        </fieldset>
         
        <fieldset v-if="gachiState!='future'" style="border: 1px solid #000000; padding: 10px;">
            <legend>あなたの記録</legend>
            <div v-if="input_data">
                <div>ブキ：{{ input_data.buki.buki_name }}</div>
                <div>ウデマエ：{{ input_data.udemae.udemae_name }}</div>
                <div>XP：{{ input_data.xp }}</div>
            </div>
            <div v-if="input_data">
                <button type="button" class="editBtn btn btn-info" @click.prevent="switchEditRecord(input_data)">戦績を編集</button>
                <button type="button" class="deleteBtn btn btn-info" @click.prevent="deleteRecord(input_data.input_data_id)">削除</button>
            </div>
            <div v-else>
                <button type="button" class="editBtn btn btn-info" @click.prevent="switchEditRecord(input_data)">戦績を入力</button>
            </div>
        </fieldset>
    </fieldset>
</template>

<script>
    export default {
        props:["gachi", "input_data", "rules", "stages", "bukis", "udemaes", "active"],
        data: function(){
            return{
                showEditRecord: false,
                gachi_id: this.gachi.gachi_id,
                nowTimeStamp: null,
                gachiStartTimeStamp: null,
                gachiEndTimeStamp: null,
                gachiState: null,
                gachiStateMsg: null,
                customizedClass: null,
                activeMsg: null,
            }
        },
        mounted(){
            this.nowTimeStamp = new Date();
            this.gachiStartTimeStamp = new Date(this.gachi.start_t);
            this.gachiEndTimeStamp = new Date(this.gachi.end_t);
            if(this.nowTimeStamp.getTime() > this.gachiEndTimeStamp.getTime()){
                this.gachiState = "past";
                this.gachiStateMsg = "終了";
            }else if(this.nowTimeStamp.getTime() > this.gachiStartTimeStamp){
                this.gachiState = "currrent";
                this.gachiStateMsg = "現在のルール";
            }else{
                this.gachiState = "future";
                this.gachiStateMsg = "開催予定";
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
            formatTimeStamp: function(timeStamp){
                let tmpTimeStamp = timeStamp;
                tmpTimeStamp = tmpTimeStamp.replace(/-/, "年");
                tmpTimeStamp = tmpTimeStamp.replace(/-/, "月");
                tmpTimeStamp = tmpTimeStamp.replace(/ /, "日 ");
                tmpTimeStamp = tmpTimeStamp.replace(/.{6}$/, "時");
                return tmpTimeStamp;
            },
        },
        watch:{
            active(value){
                if(value){
                    this.customizedClass="active";
                }else{
                    this.customizedClass="";
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
.active{
  animation: flash 2s linear infinite;
}

@keyframes flash {
  0%,100% {
    //opacity: 1;
    background:white;
  }

  50% {
    //opacity: 0.5;
    background:rgb(255, 255, 0);
  }
}

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