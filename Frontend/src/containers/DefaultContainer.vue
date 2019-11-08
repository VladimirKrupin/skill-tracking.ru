<template>
  <div class="app">

    <AppHeader style="height: 60px" fixed>

      <SidebarToggler class="d-lg-none" display="md" mobile />

      <b-link class="navbar-brand" to="/app">
        <span class="navbar-brand-minimized logo-text-min">ST</span>
        <span class="navbar-brand-full logo-text-max logo-text">Skill Tracking</span>
      </b-link>

      <SidebarToggler class="d-md-down-none" display="lg" />
      <div class="ml-auto">
        <div class="d-flex align-items-center col-sm-12 col-12 col-md-5 col-lg-5">
          <div class="d-flex flex-column mr-1">
<!--            <h5 class="mb-1"><span class="badge badge-pill badge-primary font-weight-light">Андминистратор</span></h5>-->
            <span class="text-md-left text-nowrap text-dark user-info">{{(nickname)?nickname:'User0'}}</span>
          </div>
          <b-navbar-nav>
            <DefaultHeaderDropdownAccnt/>
          </b-navbar-nav>
          <!--<AsideToggler class="d-none d-lg-block" />-->
<!--          <div class="container"></div>-->
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
      <main class="main">
          <Breadcrumb class="mb-3" :list="list"/>
        <div class="container-fluid p-xl-4 p-lg-4 p-md-4 p-0">
          <router-view></router-view>
        </div>
      </main>
      <AppAside fixed>
        <!--aside-->
        <DefaultAside/>
      </AppAside>
    </div>

    <TheFooter class="p-3 custom-footer">
      <!--footer-->
        <a href="/">{{$lang.defaultContainer.go_to_site}}</a>
      <div class="ml-auto">
        <span class="mr-1">© 2019 Skill Tracking {{$lang.defaultContainer.site}}.</span>
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
      nav: nav.get(this.$lang)
    }
  },
  computed: {
      ...mapGetters('profile', {
          email: 'email',
          nickname: 'nickname',
          lang: 'lang',
      }),
    name () {
      return this.$route.name
    },
    list () {
          console.log(this.$route);
        let matches = this.$route.matched.filter((route) => (route.meta.label)?route.meta.label:route.name);
        matches[matches.length-1].meta.label = this.$route.params.id;
        return matches;
    },
  },
  methods: {
    logout: function (event) {
      event.preventDefault();
      localStorage.removeItem('access_token');
      this.$router.push({ name: 'Login' });
    }
  },
    mounted: function () {

        console.log(this.$route);
    }
}
</script>
<style lang="scss">
    // CoreUI Icons Set
    @import '~@coreui/icons/css/coreui-icons.min.css';
    /* Import Font Awesome Icons Set */
    $fa-font-path: '~font-awesome/fonts/';
    @import '~font-awesome/scss/font-awesome.scss';
    /* Import Simple Line Icons Set */
    $simple-line-font-path: '~simple-line-icons/fonts/';
    @import '~simple-line-icons/scss/simple-line-icons.scss';
    /* Import Flag Icons Set */
    @import '~flag-icon-css/css/flag-icon.min.css';
    /* Import Bootstrap Vue Styles */
    @import '~bootstrap-vue/dist/bootstrap-vue.css';
    // Import Main styles for this application
    @import '@/assets/scss/style';

    @media (max-width: 667px) {
        .user-info {
            display: none;
        }
    }
    .logo-text {
        font-size: 14px;
    }
    .custom-footer {
        background: #ffffff;
        border-top: 1px solid #dcd8d8;
    }
</style>
