import Vue from "vue";
import Router from "vue-router";
import AppHeader from "./layout/AppHeader";
import AppFooter from "./layout/AppFooter";
import Components from "./views/Components.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Forgot from "./views/Forgot.vue";
import Profile from "./views/app/profile/Profile.vue";
import ChangePassword from "./views/app/changePassword/ChangePassword.vue";
import Policy from "./views/Policy.vue";

// Containers
const DefaultContainer = () => import('@/containers/DefaultContainer');
const Statistic = () => import('./views/app/statistics/Statistics');

Vue.use(Router);

console.log(window.location);
let location = window.location.host;
let skillArray = ['localhost:8080','skill', 'skill-tracking.ru', 'skill-tracking.com'];
let breezeArray = ['localhost:8080','breeze', 'breeze-team.ru', 'breeze-team.com'];
console.log(skillArray.indexOf(location));
console.log(typeof skillArray.indexOf(location));

export default new Router({
  linkExactActiveClass: "active",
  routes: [
        {
            path: '/app',
            name: "DefaultContainer",
            component: DefaultContainer,
            children: [
                {
                    path: '/statistic',
                    name: 'Statistic',
                    component: Statistic,
                },
                {
                    path: "/profile",
                    name: "profile",
                    component: Profile,
                },
                {
                    path: "/changePassword",
                    name: "changePassword",
                    component: ChangePassword
                },
            ],
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/",
            name: "MainPage",
            components: {
                header: AppHeader,
                default: Components,
                footer: AppFooter
            }
        },
        {
            path: "/login",
            name: "login",
            components: {
                header: AppHeader,
                default: Login,
                footer: AppFooter
            },
        },
        {
            path: "/register",
            name: "register",
            components: {
                header: AppHeader,
                default: Register,
                footer: AppFooter
            }
        },
        {
            path: "/forgot",
            name: "forgot",
            components: {
                header: AppHeader,
                default: Forgot,
                footer: AppFooter
            }
        },
        {
            path: "/policy",
            name: "policy",
            components: {
                header: AppHeader,
                default: Policy,
                footer: AppFooter
            }
        }
    ],
  scrollBehavior: to => {
    if (to.hash) {
      return { selector: to.hash };
    } else {
      return { x: 0, y: 0 };
    }
  }
});

