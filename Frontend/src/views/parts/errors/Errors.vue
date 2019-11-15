<template>
    <b-row class="p-0 m-0">
        <b-col class="p-0">
            <div v-html="errors" class="alert alert-danger alert-dismissable text-dark" v-if="errors">
            </div>
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name: 'Errors',
        props: ["errors"],
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