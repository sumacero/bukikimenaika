<template> 
    <div>
        <ul>
            <li v-for="gachi in copyGachis" :key="gachi.gachi_id" style="list-style: none;">
                <gachi-list-child v-on:click-show-edit-btn="switchEditRecord" v-on:click-delete-btn="deleteRecord" v-bind:gachi="gachi" v-bind:input_data="input_datas.filter(e=>e.gachi_id == gachi.gachi_id)[0]" v-bind:bukis="bukis" v-bind:udemaes="udemaes" v-bind:active="gachi.gachi_id==gachi_id">
                </gachi-list-child><br>
            </li>
        </ul>
        <edit-record v-if="showEditRecord" v-on:click-insert-btn="insertRecord" v-on:click-update-btn="updateRecord" v-on:click-cancel-comit-btn="switchEditRecord" v-bind:bukis="bukis" v-bind:udemaes="udemaes" v-bind:editData="editData" v-bind:gachi_id="gachi_id">
        </edit-record>
    </div>
</template>

<script>
    export default {
        props:["input_datas", "bukis", "udemaes", "gachis", "insert_record_data","osusume_buki_info"],
        data: function(){
            return{
                showEditRecord: false,
                editData: null,
                gachi_id: null,
                gachis_temp:null,
            }
        },
        computed: {
            copyGachis: function(){
                let gachis = Vue.util.extend({}, this.gachis);
                for(let i=0; i<Object.keys(gachis).length; i++){
                    for(let j=0; j<this.osusume_buki_info.targetGachiIds.length; j++){
                        if(gachis[i].gachi_id==this.osusume_buki_info.targetGachiIds[j]){
                            //オススメ上位3つを抽出
                            let osusumeBukis = this.osusume_buki_info.osusumeBukisArray[j].slice(0,5);
                            //オブジェクトにプロパティ「osusumeBukis」を追加し、値を設定。
                            //↓の書き方だと、変更が検知されない。
                            //gachis[i]["osusumeBukis"] = osusumeBukis
                            Vue.set(gachis[i],'osusumeBukis',osusumeBukis)
                            break;
                        }
                    }
                }
                return gachis
            },
        },
        methods: {
             switchEditRecord: function(input_data, gachi_id) {
                this.showEditRecord = !this.showEditRecord;
                this.editData = input_data;
                this.gachi_id = gachi_id;
             },
            deleteRecord: function(delete_input_data_id) {
                this.$emit('click-delete-btn', delete_input_data_id);
            },
            insertRecord: function(insertRecordData){
                this.$emit('click-insert-btn', insertRecordData);
            },
            updateRecord: function(updateRecordData){
                this.$emit('click-update-btn', updateRecordData);
            },
        },
    }
</script>

<style lang="scss" scoped>

ul{
    padding-left: 0px;
}

</style>