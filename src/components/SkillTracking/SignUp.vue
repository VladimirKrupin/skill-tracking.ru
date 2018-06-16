<template>
  <div class="wrapper">
    <div class="container">
      <h1 class="text text--lead">{{ title }}</h1>
      <div class="row">
        <div class="col-sm-8">
          <form action="/action_page.php" @submin.prevent="regUser">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" required v-model="user.email">
            </div>
            <div class="form-group">
              <label for="pwd">Пароль:</label>
              <input type="password" class="form-control" id="pwd" required v-model="user.pwd">
            </div>
            <div class="form-group">
              <label for="pwd2">Повторите пароль:</label>
              <input type="password2" class="form-control" id="pwd2" required v-model="user.confPwd">
            </div>
            <div class="alert alert-danger" role="alert" v-if="error">
              {{ errorText }}
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'sign-up',
  data: function () {
    return {
      title: 'Регистрация',
      error: false,
      errorText: '<strong>Упс!</strong> Пароли не совпадают!',
      user: {
        email: '',
        pwd: '',
        confPwd: ''
      }
    }
  },
  methods: {
    regUser () {

    }
  }
}
</script>
