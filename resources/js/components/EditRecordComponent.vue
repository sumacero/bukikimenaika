<template> 
    <div id="overlay">
        <div id="content">
            <form action="/update_data" method="post">
                <label for="rule_id">ルール</label>
                <select name="rule_id" v-model="ruleSelected">
                <option v-for="rule in rules" :key="rule.id" :value="rule.rule_id" >{{ rule.rule_name }}</option>
                </select>
                <br>
                <label for="stage1_id">ステージ1</label>
                <select name="stage1_id" v-model="stage1Selected">
                <option v-for="stage in stages" :key="stage.id" :value="stage.stage_id">{{ stage.stage_name }}</option>
                </select>
                <br>
                <label for="stage2_id">ステージ2</label>
                <select name="stage2_id" v-model="stage2Selected">
                <option v-for="stage in stages" :key="stage.id" :value="stage.stage_id">{{ stage.stage_name }}</option>
                </select>
                <br>
                <label for="buki_id">ブキ</label>
                <select name="buki_id" v-model="bukiSelected">
                <option v-for="buki in bukis" :key="buki.id" :value="buki.buki_id">{{ buki.buki_name }}</option>
                </select>
                <br>
                <label for="xp">ウデマエポイント</label>
                <input type="text" name="xp" value="" v-model="xpInput">
                <br>
            </form>
            <button v-on:click="cancelEditEvent">キャンセル</button>
        </div>
        
    </div>
</template>

<script>
    export default {
        props:["rules", "stages", "bukis", "editData"],
        data:function(){
            return{
                ruleSelected:this.editData.rule_id,
                stage1Selected:this.editData.stage1_id,
                stage2Selected:this.editData.stage2_id,
                bukiSelected:this.editData.buki_id,
                xpInput:this.editData.xp,
            }
        },
        methods :{
            cancelEditEvent: function(){
                this.$emit('click-edit-btn')
            },
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