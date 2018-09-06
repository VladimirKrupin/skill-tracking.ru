<template>
    <div>
        <h1>{{ info }}</h1>
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST">

                    <div class="alert alert-danger"
                         v-bind:class="{ 'hide': !error}">
                        <strong>Autorization error!</strong>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input v-model="userData.email" name="email" id="email" type="text" class="form-control">

                            <span class="help-block">
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input v-model="userData.password" name="password" id="password" type="password" class="form-control">

                            <span class="help-block">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary" v-on:click="autorization">
                                Login
                            </button>

                            <div class="btn btn-primary" v-on:click="details">
                                details
                            </div>

                            <a class="btn btn-link" href="">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                info: 'Login',
                userData: {
                    "email": '',
                    "password": '',
                },
                error: false,
            };
        },
        methods: {
            autorization: function (event) {
                event.preventDefault();
                this.error = false
                axios.post('/api/login', {
                    email: this.userData.email,
                    password: this.userData.password,
                })
                    .then(response => {
                        console.log('success');
                        console.log(response.data.success);

                        localStorage.setItem('id_token', response.data.success.token);
                        this.$router.push('/');
                    })
                    .catch(e => {
                        if (e.response.data.error !== undefined){
                            this.error = true
                        }
                    });
            },
            details: function (event) {
                let headers = {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('id_token')
                };
                const options = {
                    method: 'POST',
                    headers: headers,
                    url: '/api/details',
                };
                axios(options)
                    .then(response => {
                        console.log('success');
                        console.log(response);
                    })
                    .catch(e => {
                        console.log('catch');
                        console.log(e);
                    });
            }
        }
    }
</script>