import Vue from 'vue'
import Router from 'vue-router'
import AppMathTrainer from '@/components/AppMathTrainer'
import SkillTracking from '@/components/SkillTracking'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'SkillTracking',
      component: SkillTracking
    },
    {
      path: '/mathtrainer',
      name: 'AppMathTrainer',
      component: AppMathTrainer
    }
  ]
})
