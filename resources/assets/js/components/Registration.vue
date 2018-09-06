<template>
    <div>

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>{{ info }}</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">Register</div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="">

                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="   " required autofocus>

                                        <span class="help-block">
                                                <strong>123123</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="" required>

                                        <span class="help-block">
                                                <strong>123123</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group has-error">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        <span class="help-block">
                                                <strong>dfdsfsdf</strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <a class="btn btn-link" href="">
                                            Forgot Your Password?
                                        </a>

                                        <span class="btn btn-link" href="">
                                            <router-link :to="{ name: '/' }">Login</router-link>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                info: 'Skill Tracking'
            };
        },
    }
</script>