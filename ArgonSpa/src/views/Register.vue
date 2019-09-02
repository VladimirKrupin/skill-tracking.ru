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
                                <div class="text-center">
                                    <base-button v-on:click="register" type="primary" v-bind:class="validValues()?'':'btn-disabled'" class="my-4">{{$lang.register.create_account}}</base-button>
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
export default {
    data() {
        return {
            extended: true,
            email: '',
            name: '',
            password: '',
            agree: false,
            agreeError: false,
            mailError: false,
        };
    },
    methods: {
        register: function (){
            this.valid();
            if (this.validValues()){
                console.log('Success register');
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
