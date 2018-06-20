<template>
  <div>
    <h1 class="text text--lead">Вход</h1>
    <form @submit.prevent="regUser">
      <div class="form-group">
        <label for="email">Email:</label>
        <input v-model="postBody" type="email" class="form-control" id="email" required>
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
// import axios from 'axios'
// var $ = require("jquery");
import $ from 'jquery'
export default {
  data: function () {
    return {
      title: 'Регистрация',
      error: false,
      errorText: '<strong>Упс!</strong> Пароли не совпадают!',
      response: [],
      postBody: '',
      user: {
        email: '',
        pwd: '',
        confPwd: ''
      }
    }
  },
  methods: {
    regUser () {
      $.ajax({
        url: '/dsf/',
        dataType: 'json',
        data: '123',
        success: function (res) {
          console.log(res)
        }
      })
    }
  }
}
</script>
