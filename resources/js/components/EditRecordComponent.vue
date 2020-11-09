<template> 
    <div id="overlay">
        <div id="content">
            <form name="update-record-form">
                <label for="rule_id">ルール<span class="badge">必須</span></label>
                <select v-model="rule_id" name="rule_id">
                <option v-for="rule in rules" :key="rule.id" v-bind:value=rule.rule_id >{{ rule.rule_name }}</option>
                </select>
                <p class="errors" v-for="error in errors.rule" :key="error.rule">{{error}}</p>
                <br>
                <label for="stage1_id">ステージ1<span class="badge">必須</span></label>
                <select v-model="stage1_id" name="stage1_id">
                <option v-for="stage in stages" :key="stage.id" v-bind:value="stage.stage_id" >{{ stage.stage_name }}</option>
                </select>
                <p class="errors" v-for="error in errors.stage1" :key="error.stage1">{{error}}</p>
                <br>
                <label for="stage2_id">ステージ2<span class="badge">必須</span></label>
                <select v-model="stage2_id" name="stage2_id">
                <option v-for="stage in stages" :key="stage.id" v-bind:value="stage.stage_id" >{{ stage.stage_name }}</option>
                </select>
                <p class="errors" v-for="error in errors.stage2" :key="error.stage2">{{error}}</p>
                <br>
                <label for="buki_id">ブキ<span class="badge">必須</span></label>
                <select v-model="buki_id" name="buki_id">
                <option v-for="buki in bukis" :key="buki.id" v-bind:value="buki.buki_id" >{{ buki.buki_name }}</option>
                </select>
                <p class="errors" v-for="error in errors.buki" :key="error.buki">{{error}}</p>
                <br>
                <label for="udemae_id">ウデマエ<span class="badge">必須</span></label>
                <select v-model="udemae_id" name="udemae_id">
                <option v-for="udemae in udemaes" :key="udemae.id" v-bind:value="udemae.udemae_id" >{{ udemae.udemae_name }}</option>
                </select>
                <p class="errors" v-for="error in errors.udemae" :key="error.udemae_id">{{error}}</p>
                <br>
                <span v-if="udemae_id=='21'">
                <label for="xp">XP<span class="badge">必須</span></label>
                <input v-model="xp" type="text" name="xp">
                <p class="errors" v-for="error in errors.xp" :key="error.xp">{{error}}</p>
                <br>
                </span>
            </form>
            <button v-on:click="updateRecord">変更</button>
            <button v-on:click="cancelEditEvent">キャンセル</button>
        </div>
    </div>
</template>

<script>
    export default {
        props:["rules", "stages", "bukis", "udemaes","editData"],
        data:function(){
            return{
                input_data_id:this.editData.input_data_id,
                rule_id:this.editData.rule_id,
                stage1_id:this.editData.stage1_id,
                stage2_id:this.editData.stage2_id,
                buki_id:this.editData.buki_id,
                udemae_id:this.editData.udemae_id,
                xp:this.editData.xp,
                errors:{
                    rule:[],
                    stage1:[],
                    stage2:[],
                    buki:[],
                    udemae:[],
                    xp:[]
                },
                error:false
            }
        },
        mounted(){
            if(this.udemae_id != "21"){
                this.xp="";
            }   
        },
        methods :{
            cancelEditEvent: function(){
                this.$emit('click-cancel-edit-btn')
            },
            updateRecord: function(){
                this.validator();
                if(!this.error){
                    let postData = {
                        'input_data_id':this.input_data_id,
                        'rule_id':this.rule_id,
                        'stage1_id':this.stage1_id,
                        'stage2_id':this.stage2_id,
                        'buki_id':this.buki_id,
                        'udemae_id':this.udemae_id,
                        'xp':this.xp
                    }
                    const func = async ()=>{
                        try{
                            let res = await axios.post('update_record', postData);
                            this.$emit('click-update-btn', res.data.input_data);
                            this.$emit('click-cancel-edit-btn');
                        }
                        catch (error){
                            this.$emit('click-cancel-edit-btn');
                            console.log(error.response.data);
                            alert("サーバーエラーが発生しました。");
                        }
                    }
                    func();
                }
            },
            validator: function(){
                let rule = [];
                let stage1 = [];
                let stage2 = [];
                let buki = [];
                let udemae = [];
                let xp = [];
                let message = '';
                this.error = false;
                if(!this.rule_id){
                    message = 'ルールを選択してください。';
                    rule.push(message);
                    this.error = true;
                }
                if(!this.stage1_id){
                    message = 'ステージ1を選択してください。';
                    stage1.push(message);
                    this.error = true;
                }
                if(!this.stage2_id){
                    message = 'ステージ2を選択してください。';
                    stage2.push(message);
                    this.error = true;
                }
                if(this.stage1_id === this.stage2_id && this.stage1_id){
                    message = 'ステージ1とステージ2が重複しています。';
                    stage2.push(message);
                    this.error = true;
                }
                if(!this.buki_id){
                    message = 'ブキを選択してください。';
                    buki.push(message);
                    this.error = true;
                }
                if(!this.udemae_id){
                    message = 'ウデマエを選択してください。';
                    udemae.push(message);
                    this.error = true;
                }
                //ウデマエXの場合
                if(this.udemae_id=='21'){
                    if(!this.xp){
                        message = 'XPを入力してください。';
                        xp.push(message);
                        this.error = true;
                    }else if(!(this.xp>=1900 && this.xp<=4000) ){
                        message = 'XPは1900～4000の半角数字で入力してください。';
                        xp.push(message);
                        this.error = true;
                    }
                }
                this.errors.rule = rule;
                this.errors.stage1 = stage1;
                this.errors.stage2 = stage2;
                this.errors.buki = buki;
                this.errors.udemae = udemae;
                this.errors.xp = xp;
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