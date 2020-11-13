<template> 
    <div id="overlay">
        <div id="content">
            <form name="update-record-form">
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
            <button v-on:click="comitRecord">保存</button>
            <button v-on:click="cancelEditEvent">キャンセル</button>
        </div>
    </div>
</template>

<script>
    export default {
        props:["bukis", "udemaes","editData","gachi_id"],
        data:function(){
            return{
                input_data_id:null,
                buki_id:null,
                udemae_id:null,
                xp:null,
                insertFlag:false,
                errors:{
                    buki:[],
                    udemae:[],
                    xp:[]
                },
                error:false
            }
        },
        mounted(){
            if(this.editData){
                this.insertFlag = false;
                this.input_data_id=this.editData.input_data_id;
                this.buki_id=this.editData.buki_id;
                this.udemae_id=this.editData.udemae_id;
                this.xp=this.editData.xp;
            }else{
                this.insertFlag = true;
            }
            if(this.udemae_id != "21"){
                this.xp="";
            }   
        },
        methods :{
            cancelEditEvent: function(){
                this.$emit('click-cancel-comit-btn');
            },
            comitRecord: function(){
                if(this.insertFlag){
                    this.insertRecord();
                }else{
                    this.updateRecord();
                }
            },
            insertRecord: function(){
                this.validator();
                if(!this.error){
                    let postData = {
                        'gachi_id':this.gachi_id,
                        'buki_id':this.buki_id,
                        'udemae_id':this.udemae_id,
                        'xp':this.xp
                    }
                    const func = async ()=>{
                        try{
                            let res = await axios.post('insert_record', postData)
                            this.$emit('click-insert-btn', res.data.input_data);
                            this.$emit('click-cancel-comit-btn');
                        }
                        catch (error){
                            this.$emit('click-cancel-comit-btn');
                            console.log(error.response.data);
                            alert("サーバーエラーが発生しました。");
                        };
                    }
                    func();
                }
            },
            updateRecord: function(){
                this.validator();
                if(!this.error){
                    let postData = {
                        'input_data_id':this.input_data_id,
                        'buki_id':this.buki_id,
                        'udemae_id':this.udemae_id,
                        'xp':this.xp
                    }
                    const func = async ()=>{
                        try{
                            let res = await axios.post('update_record', postData);
                            this.$emit('click-update-btn', res.data.input_data);
                            this.$emit('click-cancel-comit-btn');
                        }
                        catch (error){
                            this.$emit('click-cancel-comit-btn');
                            console.log(error.response.data);
                            alert("サーバーエラーが発生しました。");
                        }
                    }
                    func();
                }
            },
            validator: function(){
                let buki = [];
                let udemae = [];
                let xp = [];
                let message = '';
                this.error = false;
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