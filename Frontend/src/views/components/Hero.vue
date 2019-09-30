<template>
    <section class="section-hero section-shaped my-0">
        <div class="shape shape-style-1 shape-primary">
            <span class="span-150"></span>
            <span class="span-50"></span>
            <span class="span-50"></span>
            <span class="span-75"></span>
            <span class="span-100"></span>
            <span class="span-75"></span>
            <span class="span-50"></span>
            <span class="span-100"></span>
            <span class="span-50"></span>
            <span class="span-100"></span>
        </div>
        <div class="container shape-container d-flex align-items-center">
            <div class="col px-0">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-7 text-center pt-lg">
                        <!--<img src="img/brand/white.png" style="width: 200px;" class="img-fluid">-->
                        <h4 class="text-white">{{$lang.landing.awesome}} <span v-if="name">{{name}}!</span></h4>
                        <p class="lead text-white mt-4 mb-5">{{$lang.landing.awesome_text}}</p>
                        <div class="btn-wrapper">
                            <base-button tag="a"
                                         href="/#/app"
                                         class="mb-3 mb-sm-0"
                                         type="warning"
                                         icon="fa fa-play">
                                Web app
                            </base-button>
                            <base-button tag="a"
                                         href="#"
                                         class="mb-3 mb-sm-0"
                                         type="info"
                                         icon="fa fa-apple">
                                App store
                            </base-button>
                            <base-button tag="a"
                                         href="#"
                                         class="mb-3 mb-sm-0"
                                         type="white"
                                         icon="fa fa-google">
                                Google play
                            </base-button>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-around stars-and-coded">
                    <div class="col-sm-4">
                        <span class="text-white alpha-7 ml-3">Star us on</span>
                        <a href="https://github.com/VladimirKrupin/skill-tracking.ru" target="_blank" title="Support us on Github">
                            <img src="img/brand/github-white-slim.png" style="height: 22px; margin-top: -3px">
                        </a>
                    </div>
                    <div class="col-sm-4 mt-4 mt-sm-0 coders text-right">
                        <span class="text-white alpha-7">Coded by </span>
                        <a :href="this.socials.coders_link" target="_blank" class="coders_link">{{$lang.landing.coders_label}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { mapGetters } from 'vuex';
export default {
    computed: {
        ...mapGetters('profile', {
            name: 'name',
        }),
    },
    data: function () {
        return {
        }
    }
};
</script>
<style>
    .coders_link {
        color: white;
        text-decoration: underline
    }
    .coders_link:hover {
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .coders.text-right {
            text-align: left !important;
            margin-left: 1rem;
            margin-bottom: 1rem;
        }
    }
</style>
