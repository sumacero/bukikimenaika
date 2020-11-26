<template>
    <div class="icon" v-bind:class="{'icon--plus': iconPlus, 'mB20': !iconPlus}">
        <span class="icon__mark"></span>
    </div>
</template>

<script>
    export default {
        props:["iconPlus"],
    }   
</script>
<style>
    .mB20 {
        margin-bottom: px;
    }
    .icon {
        position: relative;
        width: 20px;
        height: 20px;
        background: #ccc;
        border-radius: 50%;
    }
    .icon::before, .icon--plus::after {
        position: absolute;
        top: 9px;
        left: 50%;
        content: '';
        display: inline-block;
        width: 13px;
        height: 13px;
        border-top: 2px solid #fff;
        transform: translateX(-50%);
    }
    
    .icon--plus:after {
        top: 3px;
        left: -2.5px;
        transform: rotate(90deg);
    }
</style>