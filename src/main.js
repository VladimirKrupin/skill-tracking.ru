// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import VueTimers from 'vue-timers'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import App from './App'
import router from './router'
import StartScreen from './components/StartScreen.vue'
import ResultScreen from './components/ResultScreen.vue'
import Question from './components/Question.vue'
import Message from './components/Message.vue'
import SignIn from './components/SignIn.vue'
import SignUp from './components/SignUp.vue'
import History from './components/History.vue'

Vue.use(BootstrapVue)
Vue.use(VueTimers)

Vue.config.productionTip = false

Vue.component('StartScreen', StartScreen)
Vue.component('ResultScreen', ResultScreen)
Vue.component('Question', Question)
Vue.component('Message', Message)
Vue.component('History', History)
Vue.component('SignIn', SignIn)
Vue.component('SignUp', SignUp)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
