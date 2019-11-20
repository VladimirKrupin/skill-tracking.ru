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
import 'core-js/es6/promise'
import 'core-js/es6/string'
import 'core-js/es7/array'
import 'es6-promise/auto';

import BootstrapVue from 'bootstrap-vue'

import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import Auth from "./plugins/Auth";
import Argon from "./plugins/argon-kit";
import { store } from './store'
import commonMixin from './mixin/common';
import env from "./config/env";

Vue.use(BootstrapVue);
Vue.use(Auth);

require('./config/guards');

let Lang = require('vuejs-localization');
Lang.requireAll(require.context('./Lang', true, /\.js$/));
Vue.config.productionTip = env.production();
Vue.use(Argon);
Vue.use(Lang);

store.dispatch('skills/getSkills');
store.dispatch('profile/getAllowedLangs');
store.dispatch('profile/setUserData');

Vue.mixin(commonMixin.get());

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");

