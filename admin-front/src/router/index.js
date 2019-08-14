import Router from 'vue-router'

// Containers
const DefaultContainer = () => import('@/containers/DefaultContainer');

const Files = () => import('@/views/files/Files');
const Profile = () => import('@/views/profile/Profile');
const Login = () => import('@/views/login/Login');
const MainPage = () => import('@/views/mainPage/MainPage');

//main

export default new Router({
  mode: 'history', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: DefaultContainer,
      children: [
        {
          path: 'profile',
          name: 'Profile',
          component: Profile,
          meta: {
            requiresAuth: true
          },
        },
      ]
    },
    {
      path: '/main',
      name: 'MainPage',
      component: MainPage,
      meta: {
        requiresAuth: false
      },
    },
    {
      path: '/login',
      name: 'Login',
      meta: {
        requiresAuth: false
      },
      component: Login,
    },
  ]
})
