// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import StartScreen from './components/StartScreen.vue'
import ResultScreen from './components/ResultScreen.vue'
import Question from './components/Question.vue'
import Message from './components/Message.vue'

Vue.config.productionTip = false

Vue.component('StartScreen', StartScreen)
Vue.component('ResultScreen', ResultScreen)
Vue.component('Question', Question)
Vue.component('Message', Message)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
