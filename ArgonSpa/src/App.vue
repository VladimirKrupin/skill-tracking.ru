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
