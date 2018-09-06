<template>
    <div>
        <div id="wrapper" v-if="auth === 1">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"><router-link :to="{ name: 'home' }">Skill Tracking</router-link></a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a @click="logOut"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a><i class="fa fa-edit fa-fw"></i><router-link :to="{ name: 'sendfile' }">Отправка файлов</router-link></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <router-view></router-view>
        </div>
        <div v-if="auth === 0">
            <Login
                v-if="uri === ''"
                @checkUserToParent="checkUser"
            ></Login>
            <Registration
                v-if="uri === 'registration'"
            >
            </Registration>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                auth: 0,
                uri: window.location.pathname.replace(/\//, '')
            };
        },
        methods: {
            logOut: function () {
                localStorage.removeItem('id_token');
                this.auth = 0;
            },
            checkUser: function () {
                let headers = {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('id_token')
                };
                const options = {
                    method: 'POST',
                    headers: headers,
                    data: {},
                    url: '/api/details',
                };
                axios(options)
                    .then(response => {
                        console.log('success');
                        this.auth = 1;
                    })
                    .catch(e => {
                        console.log(e.response.data.error);
                    });
            },
        },
        mounted: function () {
            this.checkUser();
        }
    }
</script>