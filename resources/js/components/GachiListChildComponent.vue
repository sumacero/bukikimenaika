<template> 
    <fieldset v-bind:class="customizedClass" style="border: 1px solid #000000; padding: 10px;">
        <legend>{{ formatTimeStamp(gachi.start_t) }}～{{ formatTimeStamp(gachi.end_t) }}　<span v-bind:Class="textStyle">◆{{gachiStateMsg}}</span></legend>
        <fieldset style="border: 1px solid #000000; padding: 10px;">
            <div>ルール：{{ gachi.rule.rule_name }}</div>
            <div>ステージ1：{{ gachi.stage1.stage_name }}<br>
                <img v-bind:src="'images/'+gachi.stage1.stage_name+'.png'" v-bind:alt="gachi.stage1.stage_name+'.png'" width="200" height="100">
            </div>
            <div>ステージ2：{{ gachi.stage2.stage_name }}<br>
                <img v-bind:src="'images/'+gachi.stage2.stage_name+'.png'" v-bind:alt="gachi.stage2.stage_name+'.png'" width="200" height="100">
            </div>
        </fieldset>
        <fieldset v-if="gachiState!='future'" style="border: 1px solid #000000; padding: 10px;">
            <legend>あなたの記録</legend>
                <div v-if="input_data">
                    <span style="display: flex">
                        <div class="col-md-3">
                            <div>ブキ：{{ input_data.buki.buki_name }}</div>
                            <div>ウデマエ：{{ input_data.udemae.udemae_name }}</div>
                            <div>XP：{{ input_data.xp }}</div>
                            <div>{{ input_data.win}}勝／{{ input_data.lose }}負</div>
                        </div>
                        <div class="col-md-3">
                            <div>コメント：{{ input_data.comment }}</div>
                        </div>
                    </span>
                </div>
            <div v-if="input_data">
                <button type="button" class="editBtn btn btn-outline-primary btn-sm" @click.prevent="switchEditRecord(input_data)">戦績を編集</button>
                <button type="button" class="deleteBtn btn btn-outline-primary btn-sm" @click.prevent="deleteRecord(input_data.input_data_id)">削除</button>
            </div>
            <div v-else>
                <button type="button" class="editBtn btn btn-outline-primary btn-sm" @click.prevent="switchEditRecord(input_data)">戦績を入力</button>
            </div>
        </fieldset>
        <fieldset v-if="gachi.osusumeBukis" style="border: 1px solid #000000; padding: 10px;">
            <legend>あなたへオススメするブキ</legend>
            <span v-if="gachi.osusumeBukis.length>0">
                <div v-for="(osusumeBuki,index) in gachi.osusumeBukis" v-bind:key="index">
                    {{index + 1}}位　{{osusumeBuki.buki_name}}　[平均XP：{{Number(osusumeBuki.avg_xp).toFixed(1)}}　戦績数：{{osusumeBuki.input_data_count}}]
                    <span v-if="osusumeBuki.total_win && osusumeBuki.total_lose">
                        　勝率：{{winRate(osusumeBuki.total_win,osusumeBuki.total_lose)}}％（{{osusumeBuki.total_win}}勝/{{osusumeBuki.total_lose}}負）
                    </span>
                </div>
            </span>
            <span v-else>
                なし
            </span>
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
                gachiState: null,
                gachiStateMsg: null,
                customizedClass: null,
                activeMsg: null,
                textStyle: null,
            }
        },
        mounted(){
            let nowTimeStamp = new Date();
            let tmpTimeStamp = new Date();
            tmpTimeStamp.setHours(tmpTimeStamp.getHours() + 2);
            let gachiStartTimeStamp = new Date(this.gachi.start_t);
            let gachiEndTimeStamp = new Date(this.gachi.end_t);
            //現在時刻>終了時刻
            if(nowTimeStamp.getTime() > gachiEndTimeStamp.getTime()){
                this.gachiState = "past";
                this.gachiStateMsg = "過去のルール";
                this.textStyle = "bg-dark text-white";
            }
            //開始時刻<=現在時刻<=終了時刻
            if(gachiStartTimeStamp.getTime() <= nowTimeStamp.getTime() && nowTimeStamp.getTime() <= gachiEndTimeStamp.getTime()){
                this.gachiState = "currrent";
                this.gachiStateMsg = "現在のルール";
                this.textStyle = "bg-success text-white";
            }
            //開始時刻>現在時刻
            if(gachiStartTimeStamp.getTime() > nowTimeStamp.getTime()){
                this.gachiState = "future";
                this.gachiStateMsg = "未来のルール";
            }
            //開始時刻<=現在時刻+2時間<=終了時刻
            if(gachiStartTimeStamp.getTime() <= tmpTimeStamp.getTime() && tmpTimeStamp.getTime() <= gachiEndTimeStamp.getTime()){
                this.gachiState = "future";
                this.gachiStateMsg = "未来のルール(まもなく開催)";
                this.textStyle = "bg-warning text-dark";
            }
        },
        computed:{
            winRate(){
                return function(win,lose) {
                    let totalWin=Number(win);
                    let totalLose=Number(lose);
                    let winRate = (totalWin/(totalWin + totalLose))*100; 
                    return winRate.toFixed(1);
                }  
            },
        },
        methods: {
            switchEditRecord: function(input_data) {
                this.$emit('click-show-edit-btn', input_data, this.gachi_id);
            },
            deleteRecord: function(delete_input_data_id) {
                let res = window.confirm('戦績を削除します。よろしいですか。');
                    if(res){
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
                }
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