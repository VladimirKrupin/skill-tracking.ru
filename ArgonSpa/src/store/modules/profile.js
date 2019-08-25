import axios from 'axios';

const state = {
  userData: [],
};

const getters = {
    userData: state => state.userData,
    lang: state => (state.userData.lang)?console.log(state.userData.lang):'en',
};

const mutations = {
  setUserData(state, payload) {
    state.userData = payload.userData;
  },
  setLang(state, payload) {
    state.userData.lang = payload.lang;
  },
};

const actions = {
  setUserData(context) {
      const options = {
          method: 'GET',
          headers: {
              'Authorization': 'Bearer ' + localStorage.getItem('access_token')
          },
          url: window.apiHost + '/api/getUserData',
      };
      axios(options)
          .then(response => {
              context.commit('setUserData', { userData: response.data.userData });
          })
          .catch(e => {
              console.log(e);
              localStorage.removeItem('access_token');
              context.commit('setLang', {lang:'en'});
          });
  },
  changeLang(context,payload) {
      localStorage.setItem('lang',payload.lang);
      context.commit('setLang', { lang: payload.lang });
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
