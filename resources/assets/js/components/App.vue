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
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><router-link :to="{ name: 'login' }">Login</router-link></li>
                        <li><router-link :to="{ name: 'registration' }">Registration</router-link></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <h1>{{ info }}</h1>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                info: '123'
            };
        },
        mounted() {
            axios
                .get('/api/test')
                .then(response => (
                    this.info = response.data.title
                ));
        }
    }
</script>