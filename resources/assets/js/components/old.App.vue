<template>
    <div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><router-link :to="{ name: 'home' }">Skill Tracking</router-link></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right"
                        v-bind:class="{ 'hide': userData.name}">
                        <!-- Authentication Links -->
                        <li><router-link :to="{ name: 'login' }">Login</router-link></li>
                        <li><router-link :to="{ name: 'registration' }">Registration</router-link></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right"
                        v-bind:class="{ 'hide': !userData.name}">
                        <!-- Authentication Links -->
                        <li><router-link :to="{ name: 'login' }">{{userData.name}}</router-link></li>
                        <li v-on:click="logout"><a class="router-link-exact-active router-link-active">logOut</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="container">
                <div class="col-md-8 col-md-offset-2">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                userData: {
                    "name": '',
                },
            };
        },
        methods: {
            auth: function () {
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
                        this.userData.name = response.data.success.name;
                    })
                    .catch(e => {
                        console.log(e.response.data.error);
                    });
            },
            logout: function () {
                localStorage.setItem('id_token', '');
                this.userData.name = '';
            }
        },
        mounted(){
            this.auth()
        }
    }
</script>