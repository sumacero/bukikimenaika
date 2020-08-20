<template> 
    <div id="overlay">
        <div id="content">
            <form name="insert-form" action="/insert_data" method="post">
                <label for="rule_id">ルール</label>
                <select v-model="rule_id" name="rule_id">
                <option value="" disabled selected>選択してください</option>
                <option v-for="rule in rules" :key="rule.id" v-bind:value=rule.rule_id >{{ rule.rule_name }}</option>
                </select>
                <br>
                <label for="stage1_id">ステージ1</label>
                <select v-model="stage1_id" name="stage1_id">
                <option value="" disabled selected>選択してください</option>
                <option v-for="stage in stages" :key="stage.id" v-bind:value=stage.stage_id >{{ stage.stage_name }}</option>
                </select>
                <br>
                <label for="stage2_id">ステージ2</label>
                <select v-model="stage2_id" name="stage2_id">
                <option value="" disabled selected>選択してください</option>
                <option v-for="stage in stages" :key="stage.id" v-bind:value=stage.stage_id >{{ stage.stage_name }}</option>
                </select>
                <br>
                <label for="buki_id">ブキ</label>
                <select v-model="buki_id" name="buki_id">
                <option value="" disabled selected>選択してください</option>
                <option v-for="buki in bukis" :key="buki.id" v-bind:value=buki.buki_id >{{ buki.buki_name }}</option>
                </select>
                <br>
                <label for="xp">ウデマエポイント</label>
                <input v-model="xp" type="text" name="xp" value="">
                <br>
            </form>
            <button v-on:click="insertEvent">データ追加</button>
            <button v-on:click="cancelInsertEvent">キャンセル</button>
        </div>
        
    </div>
</template>

<script>
    export default {
        data () {
            return {
                rule_id: null,
                stage1_id: null,
                stage2_id: null,
                buki_id: null,
                xp: null,
            }
        },
        props:["rules", "stages", "bukis"],
        methods :{
            cancelInsertEvent: function(){
                this.$emit('click-cancel-insert-btn')
            },
            
            insertEvent: function(){
                this.$emit('click-insert-btn',{rule_id: this.rule_id, stage1_id:this.stage1_id, stage2_id:this.stage2_id, buki_id:this.buki_id,xp:this.xp})
            }
            
        }
    }
</script>

<style>
#overlay{
  /*要素を重ねた時の順番*/
  z-index:1;

  /*画面全体を覆う設定*/
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background-color:rgba(0,0,0,0.5);

  /*　画面の中央に要素を表示させる設定　*/
  display: flex;
  align-items: center;
  justify-content: center;    
}
#content{
  z-index:2;
  width:50%;
  padding: 1em;
  background:#fff;
}

</style>