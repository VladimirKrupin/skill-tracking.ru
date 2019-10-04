import Vuex from "vuex";
import Vue from 'vue'
import profile from './modules/profile'
import skills from './modules/skills'

Vue.use(Vuex);

export const store = new Vuex.Store({
  strict: true,
  modules: {
    profile,
    skills,
  }
});
