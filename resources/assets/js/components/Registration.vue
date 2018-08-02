<template>
    <div>
        <h1>{{ info }}</h1>
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input v-model="userData.name" id="name" type="text" class="form-control" name="name">
                            <p style="white-space: pre-line;">{{ userData.name }}</p>
                            <span class="help-block">
                                    <strong>123123</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input v-model="userData.email" id="email" type="email" class="form-control" name="email">

                            <span class="help-block">
                                    <strong>123123</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group has-error">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input v-model="userData.password" id="password" type="password" class="form-control" name="password">

                            <span class="help-block">
                                    <strong>dfdsfsdf</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input v-model="userData.password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="btn btn-primary" v-on:click="register">
                                Register
                            </div>
                        </div>
                    </div>

                    {{ data }}
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
                info: 'Registration',
                data: '',
                userData: {
                    "name": '',
                    "email": '',
                    "password": '',
                    "password_confirmation": '',
                },
                errors: []
            };
        },
        methods: {
            register: function (event) {
                event.preventDefault();
                axios.post('/api/register', {
                    name: this.userData.name,
                    email: this.userData.email,
                    password: this.userData.password,
                    password_confirmation: this.userData.password_confirmation
                })
                    .then(response => {
                        console.log(response)
                        this.data = response
                    })
                    .catch(e => {
                        console.log(e.response.data)
                        this.errors.push(e.response.data)
                    });
            }
        }
    }
</script>