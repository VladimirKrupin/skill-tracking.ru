<template>
    <div>
        <h1>{{ info }}</h1>
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <div class="alert alert-success"
                     v-bind:class="{ 'hide': success === false }">
                    <strong>Registration Success!</strong>
                </div>
                <form id="formRegistration" class="form-horizontal">
                    <div
                        class="form-group "
                        v-bind:class="{ 'has-error': errors.name }">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input v-model="userData.name" id="name" type="text" class="form-control" name="name">
                            <span class="help-block"
                                  v-bind:class="{ 'hide': !errors.name }">
                                    <strong>{{errors.name}}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group"
                         v-bind:class="{ 'has-error': errors.email }">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input v-model="userData.email" id="email" type="email" class="form-control" name="email">

                            <span class="help-block"
                                  v-bind:class="{ 'hide': !errors.email }">
                                    <strong>{{errors.email}}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group"
                         v-bind:class="{ 'has-error': errors.password }">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input v-model="userData.password" id="password" type="password" class="form-control" name="password">

                            <span class="help-block"
                                  v-bind:class="{ 'hide': !errors.password }">
                                    <strong>{{errors.password}}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group"
                         v-bind:class="{ 'has-error': errors.password_confirmation }">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input v-model="userData.password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation">

                            <span class="help-block"
                                  v-bind:class="{ 'hide': !errors.password_confirmation }">
                                    <strong>{{errors.password_confirmation}}</strong>
                            </span>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="btn btn-primary" v-on:click="register">
                                Register
                            </div>
                            <div class="btn btn-primary" v-on:click="details">
                                details
                            </div>
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
                info: 'Registration',
                userData: {
                    "name": '',
                    "email": '',
                    "password": '',
                    "password_confirmation": '',
                },
                errors: {
                    "name": '',
                    "email": '',
                    "password": '',
                    "password_confirmation": '',
                },
                success: false,
            };
        },
        methods: {
            formReset: function () {
                document.getElementById("formRegistration").reset();
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
            },
            register: function (event) {
                event.preventDefault();
                this.errors.name = '';
                this.errors.email = '';
                this.errors.password = '';
                this.errors.password_confirmation = '';
                this.success = false;
                let data = {
                    name: this.userData.name,
                    email: this.userData.email,
                    password: this.userData.password,
                    password_confirmation: this.userData.password_confirmation
                };
                let headers = {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('id_token')
                };
                const options = {
                    method: 'POST',
                    headers: headers,
                    data: data,
                    url: '/api/register',
                };
                axios(options)
                    .then(response => {
                        console.log('success');
                        let res = response.data;
                        let self = this;
                        self.success = true;
                        Object.keys(this.userData).forEach(function(key,index) {
                            self.userData[key] = '';
                        });
                        this.formReset();
                        setTimeout(function(){
                            self.success = false
                        }, 5000);
                        localStorage.setItem('id_token', res.success.token)
                    })
                    .catch(e => {
                        console.log('catch');
                        let errors = e.response.data;

                        if (errors.error.name !== undefined) {
                            this.errors.name = errors.error.name[0]
                        }
                        if (errors.error.email !== undefined) {
                            this.errors.email = errors.error.email[0]
                        }
                        if (errors.error.password !== undefined) {
                            this.errors.password = errors.error.password[0]
                        }
                        if (errors.error.password_confirmation !== undefined) {
                            this.errors.password_confirmation = errors.error.password_confirmation[0]
                        }

                    });
            }
        }
    }
</script>