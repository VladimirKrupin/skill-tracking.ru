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
                                <small>{{$lang.register.sign_up_with}}</small>
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
                            <div class="text-center text-muted mb-3 mt-4">
                                <small>{{$lang.register.sign_up_credentials}}</small>
                            </div>
                            <form role="form">
                                <base-input alternative
                                            v-on:input="fixError()"
                                            v-bind:class="mailErrorClass() + extendClass()"
                                            :placeholder="$lang.register.email"
                                            addon-left-icon="ni ni-email-83"
                                            v-model="email">
                                </base-input>
                                <base-input v-if="extended"
                                            alternative
                                            class="mb-2"
                                            :placeholder="$lang.register.name"
                                            addon-left-icon="ni ni-hat-3"
                                            v-model="name">
                                </base-input>
                                <base-input v-if="extended"
                                            alternative
                                            class="mb-2"
                                            type="password"
                                            :placeholder="$lang.register.password"
                                            addon-left-icon="ni ni-lock-circle-open"
                                            v-model="password">
                                </base-input>
                                <div v-if="password" class="text-muted font-italic mb-3">
                                    <small>{{$lang.register.pass_strength}}:
                                        <span class="text-success font-weight-700">{{$lang.register.strength_normal}}</span>
                                    </small>
                                </div>
                                <base-checkbox
                                        v-model="agree"
                                        v-bind:class="(agreeError)?'checkbox-error':''"
                                >
                                    <div>{{$lang.register.i_agree}}
                                        <router-link to="/policy">{{$lang.register.privacy_policy}}</router-link>
                                    </div>
                                </base-checkbox>
                                <div class="alert alert-danger alert-dismissable mt-3 mb-0" v-if="errors">
                                    <div v-for="(item,key) in errors" :key="key">
                                        {{item}}
                                    </div>
                                </div>
                                <div class="alert alert-success alert-dismissable mt-3 mb-0" v-if="success">
                                    {{$lang.register.success}}
                                </div>
                                <div class="alert alert-success alert-dismissable mt-3 mb-0" v-if="confirmationSuccess">
                                    {{$lang.register.confirmation_success}}
                                </div>
                                <div v-if="loaderMessage" class="loader loader-msg m-auto"></div>
                                <div class="text-center">
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
                                    <base-button v-if="!logged()" v-on:click="register" type="primary" v-bind:class="validValues()?'':'btn-disabled'" class="my-4">
                                        {{$lang.register.create_account}}
                                        <div v-if="loader" class="loader loader-btn"></div>
                                    </base-button>
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
                            <router-link to="/login" class="text-light">
                                <small>{{$lang.login.sign_in}}</small>
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
    data() {
        return {
            extended: false,
            email: '',
            name: '',
            password: '',
            agree: false,
            agreeError: false,
            mailError: false,
            errors: '',
            success: false,
            loader: false,
            loaderMessage: false,
            confirmationSuccess: false,
        };
    },
    methods: {
        register: function (){
            console.log(this.agree);
            this.valid();
            if (this.validValues()){
                let formData;
                if (this.extended){
                    formData = {
                        // data for extended register form
                    }
                }else {
                    formData = {
                        email: this.email,
                        host: window.document.location.origin,
                        agree: this.agree?'yes':'no',
                    }
                }
                this.errors = '';
                this.loader = true;
                this.confirmationSuccess = false;
                this.success = false;
                const options = {
                    method: 'POST',
                    headers: this.defaultHeaders,
                    data: formData,
                    url: this.apiHost+'/api/register/',
                };
                axios(options)
                    .then(response => {
                        this.success = true;
                        this.loader = false;
                    })
                    .catch(error => {
                        if (error.response !== undefined){
                            this.errors = [error.response.data.error];
                        }
                        this.loader = false;
                    });
            }
        },
        validValues: function (){
            return (this.agree && this.validEmail(this.email));
        },
        valid: function () {
            if (this.extended){
                // valid logic for extended form
            }
            if (!this.agree){
                this.agreeError = true;
            }else {
                this.agreeError = false;
            }
            if (!this.validEmail(this.email)){
                this.mailError = true;
            }else {
                this.mailError = false;
            }
        },
        validEmail: function (email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        fixError(){
            this.mailError = false;
        },
        mailErrorClass(){
            return this.mailError?'border-red ':'';
        },
        extendClass(){
            return this.extended?'mb-2':'mb-3';
        },
    },
    mounted() {
        console.log(this.$route.query.hash);
        if (this.$route.query.hash){
            this.loaderMessage = true;
            this.confirmationSuccess = false;
            this.success = false;
            const options = {
                method: 'POST',
                headers: this.defaultHeaders,
                data: {
                    hash: this.$route.query.hash,
                },
                url: this.apiHost+'/api/registerConfirmation/',
            };
            axios(options)
                .then(response => {
                    this.confirmationSuccess = true;
                    this.loaderMessage = false;
                    localStorage.setItem('access_token', response.data.data.token);
                    this.$store.dispatch('profile/setUserData');
                    this.$route.hash = '';
                })
                .catch(error => {
                    if (error.response !== undefined){
                        this.errors = [error.response.data.error];
                    }
                    this.loaderMessage = false;
                });
        }
    }
};
</script>
<style>
    .btn-disabled {
        opacity: .4;
    }
    .border-red {
        border: 1px solid red !important;
    }
    .checkbox-error .custom-control-label::before {
        border: 1px solid red;
    }
</style>
