<template> 
    <div id="overlay">
        <div id="content">
            <ul>
                <li>１．ブキを選択し、ガチマッチをする。※1つの時間帯(2時間)につき、なるべく同じブキで対戦する。</li>
                <li>２．ルールごとに戦績を入力する。</li>
                <li>３．オススメブキが更新される。</li>
                <li>４．１～３の繰り返し。ガチマッチをたくさんこなしウデマエをあげよう！</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data:function(){
            return{
            }
        },
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

ul{
    padding-left: 0px;
    list-style: none;
}

</style>