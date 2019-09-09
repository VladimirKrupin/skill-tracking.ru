<template>
  <AppHeaderDropdown right no-caret>
    <template slot="header">
<!--      <img-->
<!--      src="img/avatars/no-pick.svg"-->
<!--      class="img-avatar"-->
<!--      alt="no-pick.svg" />-->
      <div class="user-icon">
        <i class="fa fa-user"></i>
      </div>
    </template>
    <template slot="dropdown">
      <b-dropdown-header
        tag="div"
        class="text-center">
        <strong>Settings</strong>
      </b-dropdown-header>
      <b-dropdown-item :to="{name:'profile'}"><i class="fa fa-user" /> Профиль</b-dropdown-item>
      <b-dropdown-item :to="{name:'changePassword'}"><i class="fa fa-wrench" /> Изменить пароль</b-dropdown-item>
      <b-dropdown-item  v-on:click="logout"><i class="fa fa-lock" /> Выйти</b-dropdown-item>
    </template>
  </AppHeaderDropdown>
</template>

<script>
import { HeaderDropdown as AppHeaderDropdown } from '@coreui/vue'
export default {
  name: 'DefaultHeaderDropdownAccnt',
  components: {
    AppHeaderDropdown
  },
  data: () => {
    return { itemsCount: 42 }
  },
  methods: {
    logout: function (event) {
      event.preventDefault();
      localStorage.removeItem('access_token');
      window.location.href = '/';
    }
  }
}
</script>
<style>
  .user-icon {
    font-size: 20px;
    border-radius: 50%;
    border: 1px solid #f38647;
    color: #f38647;
    text-align: center;
    box-sizing: border-box;
    width: 40px;
    height: 40px;
    line-height: 37px;
    margin: 5px;
  }
  .user-icon:hover {
    border: 1px solid #cf6e19;
    color: #cf6e19;
  }
  .navbar-nav .nav-link .user-icon i {
    margin: 0;
  }
</style>