import Vuex from "vuex";
import Vue from 'vue'
import profile from './modules/profile'

Vue.use(Vuex);

export const store = new Vuex.Store({
  strict: true,
  modules: {
    profile,
  }
});
