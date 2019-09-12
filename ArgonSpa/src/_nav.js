let Lang = require('vuejs-localization');
Lang.requireAll(require.context('./Lang', true, /\.js$/));

console.log(Lang);

export default {
  items: [
    {
      title: true,
      wrapper: {
        element: '',
        attributes: {}
      }
    },
    {
      name: 'Статистика',
      url: '/statistic',
      url_name: 'Statistic',
      icon: 'icon-chart',
      description: 'Ваша статистика',
    },
  ]
}
