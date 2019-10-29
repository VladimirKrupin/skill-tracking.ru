<template>
    <div id="app">
        <router-view name="header"></router-view>
        <main>
            <fade-transition origin="center" mode="out-in" :duration="250">
                <router-view/>
            </fade-transition>
        </main>
        <router-view name="footer"></router-view>
    </div>
</template>
<script>
import { FadeTransition } from "vue2-transitions";
import { mapGetters } from 'vuex';


export default {
  components: {
    FadeTransition
  },
    methods: {
        checkLang: function () {
            let lang = 'en';
            if (localStorage.getItem('lang') !== 'undefined' && localStorage.getItem('lang') !== null){
                lang = localStorage.getItem('lang');
            }
            return lang;
        }
    },
    mounted: function () {
        this.$store.dispatch('profile/changeLang',{lang:this.checkLang()});
    },
    computed: {
        ...mapGetters('profile', {
            lang: 'lang',
        }),
        langWatcher () {
            return this.lang;
        },
        example: {
            cache: false,
            get: function () {
                return Date.now() + this.msg
            }
        }
    },
    watch: {
        langWatcher (newlang, oldlang) {
            console.log('langWatcher '+oldlang+' -> '+newlang);
            this.$store.dispatch('profile/changeLang',{lang:newlang});
            this.$lang.setLang(newlang);

        }
    },
};
</script>
<style>
    .loader {
        border: 5px solid #f3f3f3; /* Light grey */
        border-top: 5px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        position: absolute;
    }

    .loader-btn {
        right: -60px;
        top: 0;
    }

    .loader-msg {
        position: relative;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .app-container {
        min-height: calc(100vh - 214px) !important;
    }

    .card-padding {
        padding: 30px 20px 70px 20px;
        text-align: center;
    }
    .return-back-link {
        color: #0c85d0;
        cursor: pointer;
    }

    .arrow-back {
        margin-top: -30px;
    }
    @media (max-width: 768px) {
        .arrow-back {
            margin-top: 10px;
        }
    }
</style>
