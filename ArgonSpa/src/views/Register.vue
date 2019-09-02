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
                                            class="mb-2"
                                            :placeholder="$lang.register.email"
                                            addon-left-icon="ni ni-email-83">
                                </base-input>
                                <base-input v-if="extended"
                                            alternative
                                            class="mb-2"
                                            :placeholder="$lang.register.name"
                                            addon-left-icon="ni ni-hat-3">
                                </base-input>
                                <base-input v-if="extended"
                                            alternative
                                            class="mb-2"
                                            type="password"
                                            :placeholder="$lang.register.password"
                                            addon-left-icon="ni ni-lock-circle-open">
                                </base-input>
                                <div class="text-muted font-italic mb-2">
                                    <small>{{$lang.register.pass_strength}}:
                                        <span class="text-success font-weight-700">{{$lang.register.strength_normal}}</span>
                                    </small>
                                </div>
                                <base-checkbox>
                                    <div>{{$lang.register.i_agree}}
                                        <router-link to="/policy">{{$lang.register.privacy_policy}}</router-link>
                                    </div>
                                </base-checkbox>
                                <div class="text-center">
                                    <base-button type="primary" class="my-4">{{$lang.register.create_account}}</base-button>
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
            extended: false,
        };
    },
};
</script>
<style>
</style>
