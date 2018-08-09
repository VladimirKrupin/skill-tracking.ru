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
                errors: {
                    "name": '',
                    "email": '',
                    "password": '',
                },
                success: false,
                domModel: [{
                    "formRegistration": ''
                }]
            };
        },
        methods: {
            formReset: function () {
                document.getElementById("formRegistration").reset();
            },
            register: function (event) {
                event.preventDefault();
                this.errors.name = '';
                this.errors.email = '';
                this.errors.password = '';
                this.success = false;
                axios.post('/api/register', {
                    name: this.userData.name,
                    email: this.userData.email,
                    password: this.userData.password,
                    password_confirmation: this.userData.password_confirmation
                })
                    .then(response => {
                        console.log('success');
                        let self = this;
                        self.success = true;
                        Object.keys(this.userData).forEach(function(key,index) {
                            self.userData[key] = '';
                        });
                        this.formReset();
                        setTimeout(function(){
                            self.success = false
                        }, 5000);
                    })
                    .catch(e => {
                        console.log('catch');
                        if (e.response.data.errors.name) {
                            this.errors.name = e.response.data.errors.name[0]
                        }
                        if (e.response.data.errors.email) {
                            this.errors.email = e.response.data.errors.email[0]
                        }
                        if (e.response.data.errors.password) {
                            this.errors.password = e.response.data.errors.password[0]                                       }
                    });
            }
        }
    }
</script>