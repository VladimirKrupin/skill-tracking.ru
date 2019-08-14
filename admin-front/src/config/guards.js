import Vue from 'vue';
import router from '../router';

// проверим авторизирован ли пользователь
router.beforeEach( async (to, from, next) => {
  let is_authenticated  = await Vue.prototype.$auth.check();

  if (to.matched.some(record => record.meta.requiresAuth) && ! is_authenticated) {
    next({ name: 'Login' });
  } else {
    next();
  }
});

// запускается при загрузке страницы
router.onReady( async (route) => {
  let auth = route.matched.some(record => { return record.meta.requiresAuth || false });
  let is_authenticated = await Vue.prototype.$auth.check();

  if ( auth && ! is_authenticated && route.name !== 'Login') {
    router.push({ name: 'Login' });
  } else if ( auth && is_authenticated && route.name === 'Login') {
    router.push({ name: 'MainPage' });
  }
});
