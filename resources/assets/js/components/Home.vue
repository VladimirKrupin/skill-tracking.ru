<template>
    <div>

        <h1>{{ info }}</h1>

        <div class="panel panel-default">

            <div class="panel-heading">Home page</div>

            <div class="panel-body">
                <button type="button" class="btn btn-info" v-on:click="greet">Info</button>
            </div>

        </div>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                info: '123'
            };
        },
        methods: {
            greet: function (event) {
                axios
                    .get('/api/products/1')
                    .then(response => (
                        this.info = response.data
                    ));
            }
        }
    }
</script>