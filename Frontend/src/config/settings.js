export default {
  get: function (env) {
    switch (env) {
      case 'local':
        return {
          'apiHost': 'http://api-dev-skill',
          'frontHost': 'http://dev-skill'
        };
      case 'dev':
        return {
          'apiHost': 'http://api.dev.skill-tracking.ru',
          'frontHost': 'http://dev.skill-tracking.ru'
        };
      case 'prod':
        return {
          'apiHost': 'https://api.skill-tracking.com',
          'frontHost': 'https://skill-tracking.com'
        };
    }
  },
}
