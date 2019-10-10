import axios from 'axios';
import settings from "../../config/settings";
import env from "../../config/env";
let appSettings = settings.get(env.get());
const state = {
  skills: '',
};

const getters = {
    skills: state => state.skills,
};

const mutations = {
    setSkills(state, payload){
        state.skills = payload.skills;
    },
};

const actions = {
  getSkills(context) {
      if (localStorage.getItem('access_token') !== null){
          const options = {
              method: 'GET',
              headers: {
                  'Authorization': 'Bearer ' + localStorage.getItem('access_token')
              },
              url: appSettings.apiHost + '/api/getSkills/',
          };
          axios(options)
              .then(response => {
                  context.commit('setSkills', { skills: response.data.data.skills });
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
