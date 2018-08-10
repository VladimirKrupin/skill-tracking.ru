<template>
    <div>
        <h1>{{ info }}</h1>
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST">

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required autofocus>

                            <span class="help-block">
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

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
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

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