<template>
    <section class="section section-shaped section-lg my-0">
        <div class="shape shape-style-1 bg-gradient-default">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container pt-lg-md">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <card type="secondary" shadow
                          header-classes="bg-white pb-5"
                          body-classes="px-lg-5 py-lg-5"
                          class="border-0">
                        <template>
                            <div class="text-muted text-center mb-3">
                                <small>{{$lang.login.sign_with}}</small>
                            </div>
                            <div class="btn-wrapper text-center">
                                <base-button type="neutral">
                                    <img slot="icon" src="img/icons/common/github.svg">
                                    Github
                                </base-button>

                                <base-button type="neutral">
                                    <img slot="icon" src="img/icons/common/google.svg">
                                    Google
                                </base-button>
                            </div>
                        </template>
                        <template>
                            <div class="text-center text-muted mb-2 mt-2">
                                <small>{{$lang.login.sign_credentials}}</small>
                            </div>
                            <form role="form">
                                <base-input alternative
                                            class="mb-3"
                                            placeholder="Email"
                                            addon-left-icon="ni ni-email-83"
                                            v-model="userData.email">
                                </base-input>
                                <base-input alternative
                                            type="password"
                                            placeholder="Password"
                                            addon-left-icon="ni ni-lock-circle-open"
                                            v-model="userData.password">
                                </base-input>
                                <base-checkbox>
                                    {{$lang.login.remember_me}}
                                </base-checkbox>
                                <div class="alert alert-danger alert-dismissable mt-3 mb-0" v-if="errors">
                                    <div v-for="(item,key) in errors" :key="key">
                                        {{item}}
                                    </div>
                                </div>
                                <div class="alert alert-success alert-dismissable mt-3 mb-0" v-if="success">
                                    {{$lang.login.success}}
                                </div>
                                <div class="text-center ">
                                    <router-link v-if="logged()" to="/app">
                                        <span class="btn btn-neutral btn-icon my-4">
                                            <span class="btn-inner--icon">
                                                <i class="fa fa-play mr-2"></i>
                                            </span>
                                            <span class="nav-link-inner--text">
                                                {{$lang.landing.start_app}}
                                            </span>
                                        </span>
                                    </router-link>
                                    <base-button v-if="!logged()" v-on:click="autorization" type="primary" class="my-4">{{$lang.login.sign_in}}</base-button>
                                </div>
                            </form>
                        </template>
                    </card>
                    <div class="row mt-3">
                        <div class="col-6">
                            <router-link to="/forgot" class="text-light">
                                <small>{{$lang.login.forgot}}</small>
                            </router-link>
                        </div>
                        <div class="col-6 text-right">
                            <router-link to="/register" class="text-light">
                                <small>{{$lang.login.create}}</small>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import axios from 'axios';
export default {
    components: {
    },
    data() {
        return {
            errors: '',
            success: false,
            userData: {
                "email": '',
                "password": ''
            },
            countVar: '',
        };
    },
    name: 'Login',
    mounted: function () {

    },
    methods: {
        autorization: function (event) {
            event.preventDefault();
            this.errors = '';
            const options = {
                method: 'POST',
                headers: window.defaultHeaders(),
                data: {
                    email: this.userData.email,
                    password: this.userData.password,
                },
                url: window.apiHost+'/api/login/',
            };
            axios(options)
                .then(response => {
                    console.log(response.data);
                    localStorage.setItem('access_token', response.data.data.token);
                    this.success = true;
                })
                .catch(error => {
                    console.log(error);
                    if (error.response.data !== undefined){
                        this.errors = [error.response.data.error];
                    }
                });
        },
        logged: function () {
            console.log(localStorage.getItem('access_token'));
            console.log(typeof localStorage.getItem('access_token'));
            return (
                localStorage.getItem('access_token') !== null &&
                localStorage.getItem('access_token') !== undefined &&
                localStorage.getItem('access_token') !== 'undefined'
            );
        }
    }
}
</script>
<style>
</style>
