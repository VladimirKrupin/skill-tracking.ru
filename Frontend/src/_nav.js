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
              name: $lang.nav.statistic_name,
              url: '/statistic',
              url_name: 'Statistic',
              icon: 'icon-chart',
              description: $lang.nav.statistic_description,
          },
      ];
  },

}
