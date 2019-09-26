<template>
    <header class="header-global">
        <base-nav class="navbar-main" transparent type="" effect="light" expand>
            <router-link slot="brand" class="navbar-brand mr-lg-5" to="/">
                <img src="/img/brand/white.png" alt="logo">
            </router-link>
            <router-link slot="brand" class="navbar-brand mr-lg-5 hidden" to="/">
                    <div class="small-dropdown">
                        <base-dropdown tag="li" class="nav-item">
                            <a slot="title" href="#" class="nav-link" data-toggle="dropdown" role="button">
                                <!--                            <i class="ni ni-collection d-lg-none"></i>-->
                                <li class="nav-item">
                                    <a href="#" class="nav-link nav-link-icon text-white"
                                       data-toggle="tooltip">
                                        {{lang}}
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                </li>
                            </a>
                            <li v-on:click="langHandler(l)" v-for="(l,key) in langs" :key="key"
                                class="dropdown-item"
                                v-bind:class="localStorageLang(l)">
                                {{l}}
                            </li>
                        </base-dropdown>
                    </div>
            </router-link>
            <div class="row" slot="content-header" slot-scope="{closeMenu}">
                <div class="col-6 collapse-brand">
                    <a href="/">
                        <img src="/img/brand/blue.png">
                    </a>
                </div>
                <div class="col-6 collapse-close">
                    <close-button @click="closeMenu"></close-button>
                </div>
            </div>

            <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <base-dropdown class="nav-item" menu-classes="dropdown-menu-xl">
                    <a slot="title" href="#" class="nav-link" data-toggle="dropdown" role="button">
                        <i class="ni ni-ui-04 d-lg-none"></i>
                        <span class="nav-link-inner--text">{{$lang.landing.start_using}}</span>
                    </a>
                    <div class="dropdown-menu-inner">
                        <a href="#"
                           class="media d-flex align-items-center">
                            <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                                <i class="ni ni-spaceship"></i>
                            </div>
                            <div class="media-body ml-3">
                                <h6 class="heading text-primary mb-md-1">{{$lang.landing.started}}</h6>
                                <p class="description d-none d-md-inline-block mb-0">{{$lang.landing.started_text}}</p>
                            </div>
                        </a>
                        <a href="#"
                           class="media d-flex align-items-center">
                            <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
                                <i class="ni ni-planet"></i>
                            </div>
                            <div class="media-body ml-3">
                                <h5 class="heading text-warning mb-md-1">{{$lang.landing.started_video}}</h5>
                                <p class="description d-none d-md-inline-block mb-0">{{$lang.landing.started_video_text}}</p>
                            </div>
                        </a>
                    </div>
                </base-dropdown>
                <base-dropdown tag="li" class="nav-item">
                    <a slot="title" href="#" class="nav-link" data-toggle="dropdown" role="button">
                        <i class="ni ni-collection d-lg-none"></i>
                        <span class="nav-link-inner--text">{{$lang.landing.pages}}</span>
                    </a>
                    <router-link to="/" class="dropdown-item">{{$lang.landing.main}}</router-link>
                    <router-link to="/profile" class="dropdown-item">{{$lang.landing.profile}}</router-link>
                    <router-link to="/policy" class="dropdown-item">{{$lang.landing.policy}}</router-link>
                </base-dropdown>

                <base-dropdown tag="li" class="nav-item">
                    <a slot="title" href="#" class="nav-link" data-toggle="dropdown" role="button">
                        <i class="ni ni-collection d-lg-none"></i>
                        <span class="nav-link-inner--text">{{$lang.landing.auth}}</span>
                    </a>
                    <router-link to="/login" class="dropdown-item">{{$lang.landing.login}}</router-link>
                    <router-link to="/register" class="dropdown-item">{{$lang.landing.register}}</router-link>
                    <router-link to="/forgot" class="dropdown-item">{{$lang.landing.forgot}}</router-link>
                </base-dropdown>
            </ul>
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" :href="this.socials.fb" target="_blank" rel="noopener"
                       data-toggle="tooltip" :title="$lang.landing.fb">
                        <i class="fa fa-facebook-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Facebook</span>
                    </a>
                </li>
                <!--<li class="nav-item">-->
                    <!--<a class="nav-link nav-link-icon" :href="this.socials.inst"-->
                       <!--target="_blank" rel="noopener" data-toggle="tooltip" :title="$lang.landing.inst">-->
                        <!--<i class="fa fa-instagram"></i>-->
                        <!--<span class="nav-link-inner&#45;&#45;text d-lg-none">Instagram</span>-->
                    <!--</a>-->
                <!--</li>-->
                <!--<li class="nav-item">-->
                    <!--<a class="nav-link nav-link-icon" :href="this.socials.tw" target="_blank" rel="noopener"-->
                       <!--data-toggle="tooltip" :title="$lang.landing.tw">-->
                        <!--<i class="fa fa-twitter-square"></i>-->
                        <!--<span class="nav-link-inner&#45;&#45;text d-lg-none">Twitter</span>-->
                    <!--</a>-->
                <!--</li>-->
                <!--<li class="nav-item">-->
                    <!--<a class="nav-link nav-link-icon" :href="this.socials.vk" target="_blank" rel="noopener"-->
                       <!--data-toggle="tooltip" :title="$lang.landing.vk">-->
                        <!--<i class="fa fa-vk"></i>-->
                        <!--<span class="nav-link-inner&#45;&#45;text d-lg-none">Vk</span>-->
                    <!--</a>-->
                <!--</li>-->
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" :href="this.socials.git"
                       target="_blank" rel="noopener" data-toggle="tooltip" :title="$lang.landing.git">
                        <i class="fa fa-github"></i>
                        <span class="nav-link-inner--text d-lg-none">Github</span>
                    </a>
                </li>
                <li class="nav-item d-none d-lg-block ml-lg-4">
                    <router-link to="/app">
                        <span
                           class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon">
                                    <i class="fa fa-play  mr-2"></i>
                                </span>
                            <span class="nav-link-inner--text">

                                {{$lang.landing.start_app}}

                            </span>
                        </span>
                    </router-link>
                </li>
            </ul>
        </base-nav>
    </header>
</template>
<script>
import BaseNav from "@/components/BaseNav";
import BaseDropdown from "@/components/BaseDropdown";
import CloseButton from "@/components/CloseButton";
import { mapGetters } from 'vuex';


export default {
  components: {
    BaseNav,
    CloseButton,
    BaseDropdown
  },
    computed: {
        ...mapGetters('profile', {
            lang: 'lang',
        })
    },
    data() {
        return {
            langs: [
                'en',
                'ru',
            ]
        };
    },
    methods:{
        localStorageLang: function (lang) {
            if (localStorage.getItem('lang') === lang){
                return 'active router-link-active';
            }
            return '';
        },
    },
};
</script>
<style>
    .small-dropdown .dropdown-menu {
        max-width: 50px;
        min-width: 50px;
        width: 50px;
    }
    .dropdown-item {
        cursor: pointer;
    }
</style>
