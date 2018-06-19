<template>
  <div>
    <h1 class="text text--lead">Вход</h1>
    <form @submit.prevent="regUser">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" required>
      </div>
      <div class="form-group">
        <label for="pwd">Пароль:</label>
        <input type="password" class="form-control" id="pwd" required>
      </div>
      <div class="alert alert-danger" role="alert" v-if="error">
        {{ errorText }}
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
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
      console.log('submit')
      alert('123123')
    }
  }
}
</script>
