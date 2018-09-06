<template>
    <div>

        <h1>{{ info }}</h1>

        <div class="panel panel-default">

            <div class="panel-heading">Home page</div>

            <div class="panel-body">
                <button type="button" class="btn btn-info" v-on:click="greet">Info</button>
                <br>
                <br>
                {{ data }}

            </div>

        </div>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                info: 'Welcome',
                data: ''
            };
        },
        methods: {
            greet: function (event) {
                axios
                    .get('/api/prod')
                    .then(response => (
                        this.data = response.data
                    ));
            }
        }
    }
</script>