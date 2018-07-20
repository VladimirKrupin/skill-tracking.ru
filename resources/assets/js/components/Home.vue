<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" v-if="posts && posts.length">
                    <h4>{{posts}}</h4>
                </div>
                <div v-else-if="errors && errors.length">
                    {{errors}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            console.log('Компонент Home подключен.')
        },
        data: () => ({
            postBody: '',
            posts: [],
            errors: []
        }),
        created() {
            axios.post('https://api.podio.com', {
                    body: this.postBody
                })
                .then(response => {
                    console.log(response)
                    var data = JSON.parse(response.request.response)
                    this.posts = data.status
                })
                .catch(e => {
                    this.errors.push(e)
                })
        }
    }
</script>