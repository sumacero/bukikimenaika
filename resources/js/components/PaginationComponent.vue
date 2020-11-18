<template>
    <nav aria-label="Page Navigation">
        <ul class="pagination">
                <li v-if="paginationData.current_page > 1" class="page-item" v-on:click="movePage(paginationData.current_page - 1)">
                    <span  class="page-link">前</span>
                </li>
                <li v-if="paginationData.current_page > 1" class="page-item" v-on:click="movePage(1)">
                    <span class="page-link ">1</span>
                </li>
                <li v-if="paginationData.current_page > 2" class="page-item">
                    <span class="page-link ">…</span>
                </li>
            <li class="page-item" v-bind:class="{active:paginationData.current_page==paginationData.current_page}">
                <span class="page-link ">{{ paginationData.current_page }}</span>
            </li>
                <li v-if="paginationData.current_page < paginationData.last_page-1" class="page-item">
                    <span class="page-link ">…</span>
                </li>
                <li v-if="paginationData.current_page < paginationData.last_page" class="page-item" v-on:click="movePage(paginationData.last_page)">
                    <span class="page-link ">{{ paginationData.last_page }}</span>
                </li>
                <li v-if="paginationData.current_page < paginationData.last_page" class="page-item" v-on:click="movePage(paginationData.current_page + 1)">
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
                isActive:true,
            }
        },
        methods:{
            movePage:function(pageNumber){
                this.$emit('click-page-number', pageNumber);
            },
        },
        computed:{
            pageNumbers(){
                return this.items.filter(function(item){
                    return item.type
                })
            }
        }
    }
</script>
