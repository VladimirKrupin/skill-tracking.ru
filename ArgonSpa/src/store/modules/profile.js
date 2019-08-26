import axios from 'axios';

const state = {
  userData: [],
  lang: '',
};

const getters = {
    userData: state => state.userData,
    lang: state => state.lang,
};

const mutations = {
  setUserData(state, payload) {
    state.userData = payload.userData;
  },
  setLang(state, payload) {
    state.lang = payload.lang;
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
              context.commit('setLang', { userData: response.data.userData.lang });
          })
          .catch(e => {
              console.log(e);
              localStorage.removeItem('access_token');
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
