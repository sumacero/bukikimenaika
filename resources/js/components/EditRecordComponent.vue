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
                <div>
                    <label for="win">勝利数</label>
                    <input v-model="win" type="text" name="win">
                    <label for="lose">敗北数</label>
                    <input v-model="lose" type="text" name="lose">
                    <p class="errors" v-for="error in errors.win" :key="error.win">{{error}}</p>
                    <p class="errors" v-for="error in errors.lose" :key="error.lose">{{error}}</p>
                </div>
                <label for="comment">コメント</label>
                <textarea v-model="comment" ref="adjust_textarea" name="comment" cols="40"></textarea>
                <p class="errors" v-for="error in errors.comment" :key="error.comment">{{error}}</p>
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
                win:null,
                lose:null,
                comment:null,
                insertFlag:false,
                errors:{
                    buki:[],
                    udemae:[],
                    xp:[],
                    win:[],
                    lose:[],
                    comment:[]
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
                this.win=this.editData.win;
                this.lose=this.editData.lose;
                this.comment=this.editData.comment;
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
                        'xp':this.xp,
                        'win':this.win,
                        'lose':this.lose,
                        'commnet':this.comment,
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
                        'xp':this.xp,
                        'win':this.win,
                        'lose':this.lose,
                        'comment':this.comment,
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
                let win = [];
                let lose = [];
                let comment = [];
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
                if(this.win){
                    if(!(this.win>=0 && this.win<=50)){
                        message = 'WINは0～50の半角数字で入力してください。';
                        win.push(message);
                        this.error = true;
                    }
                    if(!this.lose){
                        message = 'LOSEを入力してください。';
                        lose.push(message);
                        this.error = true;
                    }
                }
                if(this.lose){
                    if(!(this.lose>=0 && this.lose<=50)){
                        message = 'LOSEは0～50の半角数字で入力してください。';
                        lose.push(message);
                        this.error = true;
                    }
                    if(!this.win){
                        message = 'WINを入力してください。';
                        win.push(message);
                        this.error = true;
                    }
                }
                if(this.comment){
                    if(this.comment.length>100){
                        message = 'コメントは100文字以内で入力してください。';
                        comment.push(message);
                        this.error = true; 
                    }
                }
                this.errors.buki = buki;
                this.errors.udemae = udemae;
                this.errors.xp = xp;
                this.errors.win = win;
                this.errors.lose = lose;
                this.errors.comment = comment;
            },
            adjustHeight(){
                const textarea = this.$refs.adjust_textarea
                const resetHeight = new Promise(function(resolve) {
                    resolve(textarea.style.height = 'auto')
                });
                resetHeight.then(function(){
                    textarea.style.height = textarea.scrollHeight + 'px'
                });
            }
        },
        watch: {
            comment() {
                this.adjustHeight();
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