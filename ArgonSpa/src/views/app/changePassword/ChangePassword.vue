<template>
<div>
  <card shadow class="card-profile" body>
      <b-row>
        <b-col class="col-md-5 col-lg-5">
          <h1 class="h3 my-4">Изменить пароль</h1>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="p-0">
          <div class="alert alert-danger alert-dismissable text-dark" v-if="errors">
              {{errors}}
          </div>
        </b-col>
      </b-row>
      <b-row class="col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="p-0">
          <div class="alert alert-success alert-dismissable text-dark" v-if="success">
            {{$lang.change.success}}
          </div>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="">
          <h3 class="h5  font-sm">Старый пароль <span style="color: #FF0000;">*</span></h3>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="mb-4 p-0">
          <b-form-group class="mb-0">
            <b-form-input type="password" id="old-password"
                          placeholder="Введите старый пароль"
                          class="form-control form-control-lg"
                          v-model="password.oldPassword"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col>
          <h3 class="h5 font-sm">Новый пароль <span style="color: #FF0000;">*</span></h3>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="mb-4 p-0">
          <b-form-group class="mb-0">
            <b-form-input type="password" id="new-password"
                          placeholder="Введите новый пароль"
                          class="form-control form-control-lg"
                          v-model="password.newPassword"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="">
          <h3 class="h5 font-sm">Подтвердите новый пароль <span style="color: #FF0000;">*</span></h3>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="mb-4 p-0">
          <b-form-group class="mb-0">
            <b-form-input type="password" id="confirm-password"
                          placeholder="Подтвердите новый пароль"
                          class="form-control form-control-lg"
                          v-model="password.newPasswordConfirm"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-12 col-sm-12  col-md-5 col-lg-5 d-flex">
          <b-button variant="outline-primary" class="mb-4 mr-3" v-on:click="changePassword" :disabled="disabled">Сохранить изменения<div v-if="loader" class="loader loader-btn"></div></b-button>
        </b-col>
      </b-row>

      <b-row>
        <b-col class="col-12">
          <div role="alert" aria-live="polite" aria-atomic="true" class="text-left mb-4 text-dark">
            Что бы поменять пароль воспользуйтесь формой ниже. <br>
            Если вы не помните свой старый пароль, то воспользуйтесь
            <router-link :to="{ name: 'forgot' }">средствами восстановления пароля</router-link>
          </div>
        </b-col>
      </b-row>
  </card>
</div>
</template>

<script>

  import axios from 'axios';

  export default {
    name: 'ChangePassword',
    data() {
      return {
        errors: '',
        success: false,
        loader: false,
        loader2: false,
        disabled: false,
        password: {
          "oldPassword": '',
          "newPassword": '',
          "newPasswordConfirm": ''
        },
      };
    },
    computed: {
    },
    mounted: function () {
    },
    methods: {
      changePassword: function (event) {
        event.preventDefault();
        if (this.checkPassword()){
          return false;
        }
        this.errors = '';
        this.success = false;
        this.disabled = true;
        this.loader = true;
        const options = {
          method: 'POST',
          headers: this.defaultHeaders,
          data: {
            password: this.password,
            host: window.document.location.origin
          },
          url: this.apiHost + '/api/changePassword/',
        };
        axios(options)
          .then(response => {
            this.success = true;
            this.disabled = false;
            this.loader = false;
          })
          .catch(error => {
            this.errors = error.response.data;
            this.disabled = false;
            this.loader = false;
          });
      },
      checkPassword(){
        if (!this.password.oldPassword){
          this.errors = "Поле старый пароль обязательное.";
          return true;
        }
        if (!this.password.newPassword){
          this.errors = "Поле новый пароль обязательное.";
          return true;
        }
        if (!this.password.newPasswordConfirm){
          this.errors = "Подтвердите новый пароль.";
          return true;
        }
        if (this.password.newPassword !== this.password.newPasswordConfirm){
          this.errors = "Пароли не совпадают.";
          return true;
        }
        if (this.password.newPassword === this.password.oldPassword){
          this.errors = "Новый пароль не отличается от старого, измените новый пароль.";
          return true;
        }
        if(this.password.newPassword.length < 5){
          this.errors = "Пароль должен быть больше 6 символов.";
          return true;
        }

        if(/^[a-zA-Z0-9- ]*$/.test(this.password.newPassword) == false){
          if(/^[а-яА-Я0-9- ]*$/.test(this.password.newPassword) == false){
            this.errors = "Пароль не должен содержать специальные символы.";
          } else {
            this.errors = "Пароль должен содержать только латинские символы.";
          }

          return true;
        }

        if(/^[\S]*$/.test(this.password.newPassword) == false){
          this.errors = "Пароль не должен содержать пробелы.";
          return true;
        }

        return false;
      },
      inputsReset: function () {
        this.password.newPassword = this.password.oldPassword = this.password.newPasswordConfirm = '';
      },
    }
  }
</script>

<style>
</style>
