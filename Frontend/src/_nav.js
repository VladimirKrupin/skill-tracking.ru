let Lang = require('vuejs-localization');
Lang.requireAll(require.context('./Lang', true, /\.js$/));

export default {
  get: function ($lang){
      return [
          {
              title: true,
              wrapper: {
                  element: '',
                  attributes: {}
              }
          },
          {
              name: $lang.nav.main_name,
              url: '/app',
              url_name: 'Main',
              icon: 'icon-home',
              description: $lang.nav.main_description,
          },
          {
              name: $lang.nav.skills_name,
              url: '/skills',
              url_name: 'Skills',
              icon: 'icon-graph',
              description: $lang.nav.skills_description,
          },
          {
              name: $lang.nav.statistic_name,
              url: '/statistic',
              url_name: 'Statistic',
              icon: 'icon-chart',
              description: $lang.nav.statistic_description,
          },
      ];
  },

}
