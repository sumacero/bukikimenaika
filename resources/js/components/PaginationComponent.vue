<template>
    <nav aria-label="Page Navigation">
        <ul class="pagination">
            <li>
                 <span  class="page-link">前</span>
            </li>
            <li class="page-item" v-for="i in this.pagination_data.last_page" v-bind:key="i" v-on:click="movePage(i)">
                <span class="page-link ">{{ i }}</span>
            </li>
            <li class="page-item">
                <span  class="page-link">次</span>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props:["pagination_data"],
        data:function(){
            return{
            }
        },
        methods:{
            movePage:function(pageNumber){
                this.$emit('click-page-number', pageNumber);
            },
            updateRecord: function(updateRecordData){
                this.$emit('click-update-btn', updateRecordData);
            },
        },
    }
</script>
