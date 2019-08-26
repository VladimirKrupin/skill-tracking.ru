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
      console.log(this.checkLang());
        this.$store.dispatch('profile/changeLang',{lang:this.checkLang()});
        this.$lang.setLang(this.checkLang());
        localStorage.setItem('lang',this.checkLang());
    },
    computed: {
    }
};
</script>
