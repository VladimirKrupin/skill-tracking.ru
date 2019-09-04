import axios from 'axios';
import settings from "../../config/settings";
import env from "../../config/env";
let appSettings = settings.get(env.get());
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
              url: appSettings.apiHost + '/api/getUserData/',
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
      localStorage.setItem('lang',payload.lang);
      context.commit('setLang', { lang: payload.lang });
  },
  setDbLang(context,payload) {
      if (localStorage.getItem('access_token') !== null){
          const options = {
              method: 'POST',
              headers: {
                  'Authorization': 'Bearer ' + localStorage.getItem('access_token')
              },
              url: appSettings.apiHost + '/api/putLang/',
              data: {
                  lang: payload.lang
              }
          };
          axios(options)
              .then(response => {
                  console.log('Switch on '+payload.lang);
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
