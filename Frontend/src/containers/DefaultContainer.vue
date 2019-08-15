<template>
  <div class="app">

    <AppHeader style="height: 60px" fixed>

      <SidebarToggler class="d-lg-none" display="md" mobile />

      <b-link class="navbar-brand" to="/">
        <img style="margin-left: -10px" class="navbar-brand-full" src="/img/brand/logo.png" width="60" height="60" alt="Fun gifs Logo">
        <img class="navbar-brand-minimized" src="/img/brand/logo-min.png" width="30" height="30" alt="CoreUI Logo">
      </b-link>

      <SidebarToggler class="d-md-down-none" display="lg" />

      <div class="ml-auto">
        <div class="d-flex align-items-center col-sm-12 col-12 offset-md-1 col-md-5 col-lg-5">
          <div class="d-flex flex-column mr-1 user-info">
            <h5 class="mb-1"><span class="badge badge-pill badge-primary font-weight-light">Андминистратор</span></h5>
            <span class="text-md-left text-nowrap text-dark">User name</span>
          </div>
          <b-navbar-nav class="ml-auto">
            <DefaultHeaderDropdownAccnt/>
          </b-navbar-nav>
          <!--<AsideToggler class="d-none d-lg-block" />-->
          <div class="container"></div>
        </div>
      </div>

    </AppHeader>

    <div style="margin-top: 60px" class="app-body bg-theme">
      <AppSidebar fixed>
        <SidebarHeader/>
        <SidebarForm/>
        <SidebarNav :navItems="nav"></SidebarNav>
        <SidebarFooter/>
        <SidebarMinimizer/>
      </AppSidebar>
      <main class="main mt-4">
        <div class="container-fluid">
          <router-view></router-view>
        </div>
      </main>
      <AppAside fixed>
        <!--aside-->
        <DefaultAside/>
      </AppAside>
    </div>

    <TheFooter>
      <!--footer-->
      <div>
        <a target="_blank" href="https://fun-gifs.ru">Перейти на сайт</a>
      </div>
      <div class="ml-auto">
        <span class="mr-1">© 2019 Skill Tracking официальный сайт. Все права защищены.</span>
      </div>
    </TheFooter>
  </div>
</template>

<script>
import nav from '@/_nav'
import { Header as AppHeader, SidebarToggler, Sidebar as AppSidebar, SidebarFooter, SidebarForm, SidebarHeader, SidebarMinimizer, SidebarNav, Aside as AppAside, AsideToggler, Footer as TheFooter, Breadcrumb } from '@coreui/vue'
import DefaultAside from './DefaultAside'
import DefaultHeaderDropdownAccnt from './DefaultHeaderDropdownAccnt'
import { mapGetters } from 'vuex'

export default {
  name: 'full',
  components: {
    AsideToggler,
    AppHeader,
    AppSidebar,
    AppAside,
    TheFooter,
    Breadcrumb,
    DefaultAside,
    DefaultHeaderDropdownAccnt,
    SidebarForm,
    SidebarFooter,
    SidebarToggler,
    SidebarHeader,
    SidebarNav,
    SidebarMinimizer
  },
  data () {
    return {
      nav: nav.items
    }
  },
  computed: {
    name () {
      return this.$route.name
    },
    list () {
      return this.$route.matched.filter((route) => route.name || route.meta.label )
    },
  },
  methods: {
    logout: function (event) {
      event.preventDefault();
      localStorage.removeItem('access_token');
      this.$router.push({ name: 'Login' });
    }
  }
}
</script>
<style>
  @media (max-width: 992px) {
    .app-header .navbar-brand {
      left: 20%;
    }
  }
  @media (max-width: 525px) {
    .app-header .navbar-brand {
      display: none;
    }
  }
  @media (max-width: 420px) {
    .app-header .user-info {
      display: none !important;
    }
  }
</style>
