<template>
    <b-col class="col-sm-12 col-12 col-md-5 col-lg-5 pt-2 arrow-back pb-3">
        <span class="return-back-link" v-on:click="returnBack()"><span class="icon-arrow-left"></span>{{$lang.common.return}}</span>
    </b-col>
</template>

<script>
    export default {
        name: 'ReturnBack',
        computed: {
        },
        data() {
            return {
            };
        },
        methods:{
        },
        mounted() {
        }
    }
</script>
<style>
</style>