<template> 
    <div>
        <ul>
            <li v-for="gachi in gachis" :key="gachi.gachi_id" style="list-style: none;">
                <gachi-list-child v-on:click-show-edit-btn="switchEditRecord" v-on:click-delete-btn="deleteRecord" v-bind:gachi="gachi" v-bind:input_data="input_datas.filter(e=>e.gachi_id == gachi.gachi_id)[0]"  v-bind:bukis="bukis" v-bind:udemaes="udemaes" v-bind:active="gachi.gachi_id==gachi_id">
                </gachi-list-child><br>
            </li>
        </ul>
        <edit-record v-if="showEditRecord" v-on:click-insert-btn="insertRecord" v-on:click-update-btn="updateRecord" v-on:click-cancel-comit-btn="switchEditRecord" v-bind:bukis="bukis" v-bind:udemaes="udemaes" v-bind:editData="editData" v-bind:gachi_id="gachi_id">
        </edit-record>
    </div>
</template>

<script>
    export default {
        props:["input_datas", "bukis", "udemaes", "gachis", "insert_record_data"],
        data: function(){
            return{
                showEditRecord: false,
                editData: null,
                gachi_id: null,
            }
        },
        methods: {
             switchEditRecord: function(input_data, gachi_id) {
                 if(this.showEditRecord){

                 }
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