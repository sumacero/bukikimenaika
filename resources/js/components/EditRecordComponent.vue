<template>
  <div id="overlay">
    <div id="content">
      <form name="update-record-form">
        <label for="buki_id">ブキ<span class="badge">必須</span></label><br>
        <select id="buki-pull" v-model="buki_id" name="buki_id">
          <option
            v-for="buki in bukis"
            :key="buki.id"
            v-bind:value="buki.buki_id"
          >
            {{ buki.buki_name }}
          </option>
        </select>
        <p class="errors" v-for="error in errors.buki" :key="error.buki">
          {{ error }}
        </p>
        <br>
        <br>
        <label for="udemae_id">ウデマエ<span class="badge">必須</span></label><br>
        <select v-model="udemae_id" name="udemae_id">
          <option
            v-for="udemae in udemaes"
            :key="udemae.id"
            v-bind:value="udemae.udemae_id"
          >
            {{ udemae.udemae_name }}
          </option>
        </select>
        <p class="errors" v-for="error in errors.udemae" :key="error.udemae_id">
          {{ error }}
        </p>
        <br>
        <br>
        <span v-if="udemae_id == '21'">
            <label for="xp">XP<span class="badge">必須</span></label><br>
            <input v-model="xp" type="text" name="xp" />
            <br>
            <button  type="button"
                v-on:click="countDownXp(100)"
                class="btn btn-outline-primary btn-sm"
            >-100
            </button>
            <button  type="button"
                v-on:click="countDownXp(10)"
                class="btn btn-outline-primary btn-sm"
            >-10
            </button>
            <button  type="button"
                v-on:click="countDownXp(1)"
                class="btn btn-outline-primary btn-sm"
            >-1
            </button>
            <button  type="button"
                v-on:click="countUpXp(1)"
                class="btn btn-outline-primary btn-sm"
            >+1
            </button>
            <button  type="button"
                v-on:click="countUpXp(10)"
                class="btn btn-outline-primary btn-sm"
            >+10
            </button>
            <button  type="button"
                v-on:click="countUpXp(100)"
                class="btn btn-outline-primary btn-sm"
            >+100
            </button>
            <br>
          <p class="errors" v-for="error in errors.xp" :key="error.xp">
            {{ error }}
          </p>
          <br>
        </span>
        <div>
            <label for="win">WIN&nbsp;</label>
            <input id="win-text" v-model="win" type="text" name="win" />
            <button  type="button"
                v-on:click="countDown('win')"
                class="btn btn-outline-primary btn-sm"
            >-1
            </button>
            <button  type="button"
                v-on:click="countUp('win')"
                class="btn btn-outline-primary btn-sm"
            >+1
            </button>
            <br>
            <label for="lose">LOSE</label>
            <input id="lose-text" v-model="lose" type="text" name="lose" />
            <button  type="button"
                v-on:click="countDown('lose')"
                class="btn btn-outline-primary btn-sm"
            >-1
            </button>
            <button  type="button"
                v-on:click="countUp('lose')"
                class="btn btn-outline-primary btn-sm"
            >+1
            </button>
            <p class="errors" v-for="error in errors.win" :key="error.win">
                {{ error }}
            </p>
            <p class="errors" v-for="error in errors.lose" :key="error.lose">
                {{ error }}
            </p>
        </div>
        <br>
        <label for="comment">コメント</label>
        <textarea
            id="comment-text"
            v-model="comment"
            ref="adjust_textarea"
            name="comment"
        ></textarea>
        <p class="errors" v-for="error in errors.comment" :key="error.comment">
          {{ error }}
        </p>
      </form>
      <button v-on:click="comitRecord" class="btn btn-outline-primary btn-sm">
        保存
      </button>
      <button
        v-on:click="cancelEditEvent"
        class="btn btn-outline-primary btn-sm"
      >
        キャンセル
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["bukis", "udemaes", "editData", "gachi_id"],
  data: function () {
    return {
      input_data_id: null,
      buki_id: null,
      udemae_id: null,
      xp: null,
      win: null,
      lose: null,
      comment: null,
      insertFlag: false,
      errors: {
        buki: [],
        udemae: [],
        xp: [],
        win: [],
        lose: [],
        comment: [],
      },
      error: false,
    };
  },
  mounted() {
    if (this.editData) {
      this.insertFlag = false;
      this.input_data_id = this.editData.input_data_id;
      this.buki_id = this.editData.buki_id;
      this.udemae_id = this.editData.udemae_id;
      this.xp = this.editData.xp;
      this.win = this.editData.win;
      this.lose = this.editData.lose;
      this.comment = this.editData.comment;
    } else {
      this.insertFlag = true;
    }
    if (this.udemae_id != "21") {
      this.xp = "";
    }
  },
  methods: {
    countUp:function(result){
        if(result == "win"){
            if((this.win + this.lose)<50){
                this.win++;
            }
        }else if(result == "lose"){
            if((this.win + this.lose)<50){
                this.lose++;
            }
        }
    },
    countDown:function(result){
        if(result == "win"){
            if((this.win)>0){
                this.win--;
            }
        }else if(result == "lose"){
            if((this.lose)>0){
                this.lose--;
            }
        }
    },
    countUpXp:function(n){
        if(this.xp == ""){
            this.xp = 2000;
        }
        let tempN = Number(n);
        let tempXp = Number(this.xp);
        if((tempN != NaN) && (tempXp != NaN)){
            if(tempXp + tempN <= 4000){
                this.xp = tempXp + tempN;
            }
        }
    },
    countDownXp:function(n){
        if(this.xp == ""){
            this.xp = 2000;
        }
        let tempN = Number(n);
        let tempXp = Number(this.xp);
        if((tempN != NaN) && (tempXp != NaN)){
            if(tempXp - tempN >= 1900){
                this.xp = tempXp - tempN;
            }
        }
    },

    cancelEditEvent: function () {
      this.$emit("click-cancel-comit-btn");
    },
    comitRecord: function () {
      if (this.insertFlag) {
        this.insertRecord();
      } else {
        this.updateRecord();
      }
    },
    insertRecord: function () {
      this.validator();
      this.xp = Number(this.xp).toFixed(1);
      if (!this.error) {
        let postData = {
          gachi_id: this.gachi_id,
          buki_id: this.buki_id,
          udemae_id: this.udemae_id,
          xp: this.xp,
          win: this.win,
          lose: this.lose,
          comment: this.comment,
        };
        const func = async () => {
          try {
            let res = await axios.post("insert_record", postData);
            this.$emit("click-insert-btn", res.data.input_data);
            this.$emit("click-cancel-comit-btn");
          } catch (error) {
            this.$emit("click-cancel-comit-btn");
            console.log(error.response.data);
            alert("サーバーエラーが発生しました。");
          }
        };
        func();
      }
    },
    updateRecord: function () {
      this.validator();
      if (!this.error) {
        this.validator();
        this.xp = Number(this.xp).toFixed(1);
        let postData = {
          input_data_id: this.input_data_id,
          buki_id: this.buki_id,
          udemae_id: this.udemae_id,
          xp: this.xp,
          win: this.win,
          lose: this.lose,
          comment: this.comment,
        };
        const func = async () => {
          try {
            let res = await axios.post("update_record", postData);
            this.$emit("click-update-btn", res.data.input_data);
            this.$emit("click-cancel-comit-btn");
          } catch (error) {
            this.$emit("click-cancel-comit-btn");
            console.log(error.response.data);
            alert("サーバーエラーが発生しました。");
          }
        };
        func();
      }
    },
    validator: function () {
        let buki = [];
        let udemae = [];
        let xp = [];
        let win = [];
        let lose = [];
        let comment = [];
        let message = "";
        this.error = false;
        if (!this.buki_id) {
            message = "ブキを選択してください。";
            buki.push(message);
            this.error = true;
        }
        if (!this.udemae_id) {
            message = "ウデマエを選択してください。";
            udemae.push(message);
            this.error = true;
        }
        //ウデマエXの場合
        if (this.udemae_id == "21") {
            if (!this.xp) {
                message = "XPを入力してください。";
                xp.push(message);
                this.error = true;
            } else if (!(this.xp >= 1900 && this.xp <= 4000)) {
                message = "XPは1900～4000の半角数字で入力してください。";
                xp.push(message);
                this.error = true;
            }
        }
        if (this.win !== undefined) {
            if (this.win < 0 || !Number.isInteger(Number(this.win))) {
                message = "WINは0以上の半角整数で入力してください。";
                win.push(message);
                this.error = true;
            }
            if (this.lose == undefined) {
                message = "LOSEを入力してください。";
                lose.push(message);
                this.error = true;
            }
        }
        if (this.lose !== undefined) {
            if (this.lose < 0 || !Number.isInteger(Number(this.lose))) {
                message = "LOSEは0以上の半角整数で入力してください。";
                lose.push(message);
                this.error = true;
            }
            if (this.win == undefined) {
                message = "WINを入力してください。";
                win.push(message);
                this.error = true;
            }else if (Number(this.win) + Number(this.lose) > 50) {
                message = "WINとLOSEの合計が50以下になるように入力してください。";
                lose.push(message);
                this.error = true;
            }else if (Number(this.win) + Number(this.lose) < 1){
                message = "WINとLOSEの合計が1以上になるように入力してください。";
                lose.push(message);
                this.error = true;
            }
        }
        if (this.comment) {
            if (this.comment.length > 100) {
            message = "コメントは100文字以内で入力してください。";
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
    adjustHeight() {
      const textarea = this.$refs.adjust_textarea;
      const resetHeight = new Promise(function (resolve) {
        resolve((textarea.style.height = "auto"));
      });
      resetHeight.then(function () {
        textarea.style.height = textarea.scrollHeight + "px";
      });
    },
  },
  watch: {
    comment() {
      this.adjustHeight();
    },
  },
};
</script>

<style>
#overlay {
  /*要素を重ねた時の順番*/
  z-index: 1;

  /*画面全体を覆う設定*/
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);

  /*　画面の中央に要素を表示させる設定　*/
  display: flex;
  align-items: center;
  justify-content: center;
}

#buki-pull {
    width: 45vw;
}

#content {
  z-index: 2;
  width: 50%;
  padding: 1em;
  background: #fff;
}

#win-text,
#lose-text {
  width: 10vw;
}

#comment-text {
  width: 45vw;
}
</style>