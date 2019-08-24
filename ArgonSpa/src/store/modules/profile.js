import axios from 'axios';

const state = {
  userData: [],
};

const getters = {
  userName: state => state.userData.name,
};

const mutations = {
  setUserData(state, payload) {
    state.userData = payload.userData;
  },
};

const actions = {
  setUserData(context) {
      context.commit('setUserData', { userData: 'Vladimir Krupin' });
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
