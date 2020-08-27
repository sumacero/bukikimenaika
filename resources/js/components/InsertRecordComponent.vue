<template> 
    <div id="overlay">
        <div id="content">
            <form name="insert-form" action="/insert_data" method="post">
                <label for="rule_id">ルール<span class="badge">必須</span></label>
                <select v-model="rule_id" name="rule_id">
                <option value="" disabled selected>選択してください</option>
                <option v-for="rule in rules" :key="rule.id" v-bind:value=rule.rule_id >{{ rule.rule_name }}</option>
                </select>
                <p class="errors" v-for="error in errors.rule" :key="error.rule">{{error}}</p>
                <br>
                <label for="stage1_id">ステージ1<span class="badge">必須</span></label>
                <select v-model="stage1_id" name="stage1_id">
                <option value="" disabled selected>選択してください</option>
                <option v-for="stage in stages" :key="stage.id" v-bind:value="stage.stage_id" >{{ stage.stage_name }}</option>
                </select>
                <p class="errors" v-for="error in errors.stage1" :key="error.stage1">{{error}}</p>
                <br>
                <label for="stage2_id">ステージ2<span class="badge">必須</span></label>
                <select v-model="stage2_id" name="stage2_id">
                <option value="" disabled selected>選択してください</option>
                <option v-for="stage in stages" :key="stage.id" v-bind:value="stage.stage_id" >{{ stage.stage_name }}</option>
                </select>
                <p class="errors" v-for="error in errors.stage2" :key="error.stage2">{{error}}</p>
                <br>
                <label for="buki_id">ブキ<span class="badge">必須</span></label>
                <select v-model="buki_id" name="buki_id">
                <option value="" disabled selected>選択してください</option>
                <option v-for="buki in bukis" :key="buki.id" v-bind:value="buki.buki_id" >{{ buki.buki_name }}</option>
                </select>
                <p class="errors" v-for="error in errors.buki" :key="error.buki">{{error}}</p>
                <br>
                <label for="xp">ウデマエポイント<span class="badge">必須</span></label>
                <input v-model="xp" type="text" name="xp" value="">
                <p class="errors" v-for="error in errors.xp" :key="error.xp">{{error}}</p>
                <br>
            </form>
            <button v-on:click="insertRecord">データ追加</button>
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
                errors:{
                    rule:[],
                    stage1:[],
                    stage2:[],
                    buki:[],
                    xp:[]
                },
                error:false
            }
        },
        props:["rules", "stages", "bukis"],
        methods :{
            cancelInsertEvent: function(){
                this.$emit('click-cancel-insert-btn')
            },
            
            insertRecord: function(){
                this.validator();
                if(!this.error){
                    let postData = {
                        'rule_id':this.rule_id,
                        'stage1_id':this.stage1_id,
                        'stage2_id':this.stage2_id,
                        'buki_id':this.buki_id,
                        'xp':this.xp
                    }
                    const func = async ()=>{
                        let res = await axios.post('/api/insert_record/', postData);
                        this.$emit('click-insert-btn', res.data.input_data);
                        this.$emit('click-cancel-insert-btn');
                    }
                    func();
                }
            },

            validator: function(){
                let rule = [];
                let stage1 = [];
                let stage2 = [];
                let buki = [];
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
                if(!this.xp){
                    message = 'ウデマエを入力してください。';
                    buki.push(message);
                    this.error = true;
                }else if(!(this.xp>=1000 && this.xp<=4000) ){
                    message = 'xpは1000～4000の半角数字で入力してください。';
                    xp.push(message);
                    this.error = true;
                }
                this.errors.rule = rule;
                this.errors.stage1 = stage1;
                this.errors.stage2 = stage2;
                this.errors.buki = buki;
                this.errors.xp = xp;
            },
        },
        computed:{
            insertRecordData(){
                let insertRecordData={
                    rule_id:this.rule_id,
                    stage1_id:this.stage1_id,
                    stage2_id:this.stage2_id,
                    buki_id:this.buki_id,
                    xp:this.xp,
                };
                return insertRecordData;
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