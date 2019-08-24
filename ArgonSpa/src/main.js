/*!

=========================================================
* Vue Argon Design System - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-design-system/blob/master/LICENSE.md)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import Auth from "./plugins/Auth";
import Argon from "./plugins/argon-kit";
import './registerServiceWorker'
import { store } from './store'

Vue.use(Auth);

require('./config/guards');

import settings from './config/settings';
let Env = settings.get('local');
window.apiHost = Env.apiHost;
window.socials = {
  'git':'https://github.com/VladimirKrupin/skill-tracking.ru',
  'vk':'https://vk.com/?id=244842255',
  'fb':'https://www.facebook.com/profile.php?id=100021975798495',
  'inst':'https://www.instagram.com/vladimir_togliatti/',
  'tw':'https://twitter.com/Vladimir_Krpn',
  'coders_link':'https://vk.com/?id=244842255',
  'about_us':'https://vk.com/?id=244842255',
  'news':'https://vk.com/?id=244842255',
  'mit':'https://github.com/VladimirKrupin/skill-tracking.ru/LICENSE.md',
};

var Lang = require('vuejs-localization');
Lang.requireAll(require.context('./Lang', true, /\.js$/));
Vue.config.productionTip = false;
Vue.use(Argon);
Vue.use(Lang);

store.dispatch('profile/setUserData');

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
