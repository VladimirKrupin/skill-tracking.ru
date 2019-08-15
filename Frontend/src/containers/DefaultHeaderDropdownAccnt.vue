<template>
  <AppHeaderDropdown right no-caret>
    <template slot="header">
      <img
      src="img/avatars/no-pick.svg"
      class="img-avatar"
      alt="no-pick.svg" />
    </template>
    <template slot="dropdown">
      <b-dropdown-header
        tag="div"
        class="text-center">
        <strong>Settings</strong>
      </b-dropdown-header>
      <b-dropdown-item :to="{name:'Profile'}"><i class="fa fa-wrench" /> Профиль</b-dropdown-item>
      <!--<b-dropdown-item :to="{name:'ChangePassword'}"><i class="fa fa-wrench" /> Изменить пароль</b-dropdown-item>-->
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
      this.$router.push({ name: 'Login' });
    }
  }
}
</script>
