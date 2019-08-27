import axios from 'axios';

const state = {
  email: '',
  name: '',
  lang: '',
};

const getters = {
    email: state => state.email,
    name: state => state.name,
    lang: state => state.lang,
};

const mutations = {
    setEmail(state, payload) {
        state.email = payload.email;
    },
    setName(state, payload) {
        state.name = payload.name;
    },
    setLang(state, payload) {
            state.lang = payload.lang;
    },
};

const actions = {
  setUserData(context) {
      if (localStorage.getItem('access_token') !== null){
          const options = {
              method: 'GET',
              headers: {
                  'Authorization': 'Bearer ' + localStorage.getItem('access_token')
              },
              url: window.apiHost + '/api/getUserData/',
          };
          axios(options)
              .then(response => {
                  console.log(response);
                  context.commit('setEmail', { email: response.data.data.email });
                  context.commit('setName', { name: response.data.data.name });
                  context.commit('setLang', { lang: response.data.data.lang });
                  if (localStorage.getItem('lang') !== response.data.data.lang){
                      context.dispatch('changeLang', { lang: response.data.data.lang });
                  }
              })
              .catch(e => {
                  console.log(e);
              });
      }
  },
  changeLang(context,payload) {
      console.log('changeLang '+payload.lang);
      localStorage.setItem('lang',payload.lang);
      context.commit('setLang', { lang: payload.lang });
  },
  setDbLang(context,payload) {
      console.log('setDbLang '+payload.lang);
      context.dispatch('changeLang', { lang: payload.lang });
      if (localStorage.getItem('access_token') !== null){
          const options = {
              method: 'POST',
              headers: {
                  'Authorization': 'Bearer ' + localStorage.getItem('access_token')
              },
              url: window.apiHost + '/api/putLang/',
              data: {
                  lang: payload.lang
              }
          };
          axios(options)
              .then(response => {
                  console.log(response);
              })
              .catch(e => {
                  console.log(e);
              });
      }
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
