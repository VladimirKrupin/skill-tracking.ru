<template>
  <div class="return-lk" >
    <router-link class="mr-2 return-text" :to="{ name: 'MainPage' }">
      Личный кабинет
      <img
        src="/img/avatars/no-pick.svg"
        class="img-avatar"
        alt="no-pick.svg"/>
    </router-link>

  </div>
</template>

<script>
  export default {
    name: 'ReturnLk'
  }
</script>

<style scoped>
  .return-text {
    font-size: 16px;
    color: #23282c;
  }
  .return-lk{
    position: absolute;
    top: 30px;
    right: 30px;
  }
  .img-avatar {
    width: 50px;
    height: 50px;
    cursor: pointer;
  }
</style>

