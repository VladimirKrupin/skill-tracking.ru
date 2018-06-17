// common modules
import Vue from 'vue'
import VueTimers from 'vue-timers'
import BootstrapVue from 'bootstrap-vue'
import Icon from 'vue-awesome/components/Icon'
import 'axios'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import './assets/css/styles.css'
import './assets/less/styles.less'
import 'vue-awesome/icons'
// base moduls
import App from './App.vue'
import router from './router'
import MainHeader from './components/base/MainHeader'
import MainFooter from './components/base/MainFooter'
// app math trainer
import StartScreen from './components/AppMathTrainer/StartScreen.vue'
import ResultScreen from './components/AppMathTrainer/ResultScreen.vue'
import Question from './components/AppMathTrainer/Question.vue'
import Message from './components/AppMathTrainer/Message.vue'
import History from './components/AppMathTrainer/History.vue'
// app skill tracking
import SignUp from './components/SkillTracking/SignUp.vue'
import SignIn from './components/SkillTracking/SignIn.vue'

// vue config productionTip
Vue.config.productionTip = false
Vue.use(BootstrapVue)
Vue.use(VueTimers)
Vue.component('icon', Icon)
// app math trainer
Vue.component('StartScreen', StartScreen)
Vue.component('ResultScreen', ResultScreen)
Vue.component('Question', Question)
Vue.component('Message', Message)
Vue.component('History', History)
// app skill tracking
Vue.component('SignIn', SignIn)
Vue.component('SignUp', SignUp)
/* eslint-disable no-new */
Vue.component('App', App)
Vue.component('MainHeader', MainHeader)
Vue.component('MainFooter', MainFooter)
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
