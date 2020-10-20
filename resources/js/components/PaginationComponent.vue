<template>
    <nav aria-label="Page Navigation">
        <ul class="pagination">
            <li>
                 <span  class="page-link">前</span>
            </li>
            <li 
            class="page-item"
            v-bind:class="{active:i==paginationData.current_page}"
            v-for="i in paginationData.last_page" v-bind:key="i" v-on:click="movePage(i)">
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
        props:["paginationData"],
        data:function(){
            return{
                isActive:true
            }
        },
        methods:{
            movePage:function(pageNumber){
                this.$emit('click-page-number', pageNumber);
            },
        },
    }
</script>
