import Router from 'vue-router'

// Containers
const DefaultContainer = () => import('@/containers/DefaultContainer');

const Login = () => import('@/views/login/Login');
const MainPage = () => import('@/views/mainPage/MainPage');
const Profile = () => import('@/views/profile/Profile');

//main

export default new Router({
  mode: 'history', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      name: 'Home',
      redirect: '/main',
      component: DefaultContainer,
      children: [
        {
          path: '/main',
          name: 'MainPage',
          component: MainPage,
        },
        {
          path: '/profile',
          name: 'Profile',
          component: Profile,
        },
      ],
      meta: {
        requiresAuth: true
      }
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
