import axios from 'axios';
import settings from "../../config/settings";
import env from "../../config/env";
let appSettings = settings.get(env.get());
const state = {
    skills: '',
    skillData: '',
};

const getters = {
    skills: state => state.skills,
    skillData: state => state.skillData,
};

const mutations = {
    setSkills(state, payload){
        state.skills = payload.skills;
    },
    setSkillData(state, payload){
        state.skillData = payload.skillData;
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
  getSkillData(context) {
      if (localStorage.getItem('access_token') !== null){
          const options = {
              method: 'POST',
              headers: {
                  'Authorization': 'Bearer ' + localStorage.getItem('access_token')
              },
              data: {},
              url: appSettings.apiHost + '/api/getSkillsData/',
          };
          axios(options)
              .then(response => {
                  context.commit('setSkillData', { skillData: response.data.data.skillData });
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
