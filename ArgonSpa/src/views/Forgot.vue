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
                            <div class="text-center text-muted mb-3 mt-4">
                                <small>{{$lang.forgot.forgot}}</small>
                            </div>
                            <form role="form">
                                <base-input alternative
                                            v-on:input="fixError()"
                                            v-bind:class="mailErrorClass()"
                                            :placeholder="$lang.register.email"
                                            addon-left-icon="ni ni-email-83"
                                            v-model="email">
                                </base-input>

                                <div class="alert alert-danger alert-dismissable mt-3 mb-0" v-if="errors">
                                    <div v-for="(item,key) in errors" :key="key">
                                        {{item}}
                                    </div>
                                </div>
                                <div class="alert alert-success alert-dismissable mt-3 mb-0" v-if="success">
                                    {{$lang.forgot.success}}
                                </div>
                                <div class="alert alert-success alert-dismissable mt-3 mb-0" v-if="successReset">
                                    {{$lang.forgot.success_reset}}
                                </div>
                                <div v-if="loaderMessage" class="loader loader-msg m-auto"></div>
                                <div class="text-center">
                                    <base-button  v-on:click="forgot" v-on:keyup.enter="forgot" type="primary" v-bind:class="validValues()?'':'btn-disabled'" class="my-4">
                                        {{$lang.forgot.restore}}
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
            email: '',
            mailError: false,
            errors: '',
            success: false,
            successReset: false,
            loader: false,
            loaderMessage: false,
        };
    },
    methods: {
        forgot: function (){
            this.valid();
            if (this.validValues()){
                this.errors = '';
                this.success = false;
                this.successReset = false;
                this.loader = true;
                const options = {
                    method: 'POST',
                    headers: this.defaultHeaders,
                    data: {
                        email: this.email,
                        host: window.document.location.origin
                    },
                    url: this.apiHost+'/api/forgot/',
                };
                axios(options)
                    .then(response => {
                        console.log(response.data);
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
            return (this.validEmail(this.email));
        },
        valid: function () {
            if (!this.validEmail(this.email)){
                this.mailError = true;
            }else {
                this.mailError = false;
            }
        },
        fixError(){
            this.mailError = false;
        },
        mailErrorClass(){
            return this.mailError?'border-red ':'';
        },
    },
    mounted() {
        if (this.$route.query.hash !== ''){
            this.loaderMessage = true;
            const options = {
                method: 'POST',
                headers: this.defaultHeaders,
                data: {
                    hash: this.$route.query.hash,
                },
                url: this.apiHost+'/api/resetPassword/',
            };
            axios(options)
                .then(response => {
                    this.successReset = true;
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
