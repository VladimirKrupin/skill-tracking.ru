import Vue from 'vue';
import router from '../router';

// проверим авторизирован ли пользователь
router.beforeEach( async (to, from, next) => {
  let is_authenticated  = await Vue.prototype.$auth.check();

  if (to.matched.some(record => record.meta.requiresAuth) && ! is_authenticated) {
    // next({ name: 'login' });
      // window.location.href = '/login/';
      window.location.replace(window.location.origin+"/#/login");
      window.location.reload();
  } else {
    next();
  }
});

// запускается при загрузке страницы
router.onReady( async (route) => {
  let auth = route.matched.some(record => { return record.meta.requiresAuth || false });
  let is_authenticated = await Vue.prototype.$auth.check();

  if ( auth && ! is_authenticated && route.name !== 'login') {
    // router.push({ name: 'login' });
      // window.location.href = '/login/';
      window.location.replace(window.location.origin+"/#/login");
      window.location.reload();
  } else if ( auth && is_authenticated && route.name === 'login') {
    // router.push({ name: 'MainPage' });
  }
});
