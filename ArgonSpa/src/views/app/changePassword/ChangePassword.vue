<template>
<div>
  <card shadow class="card-profile" body>
    <b-row>
      <b-col class=" col-md-5 col-lg-5">
        <h1 class="h1 my-4">Изменить пароль</h1>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5">
        <div role="alert" aria-live="polite" aria-atomic="true" class="text-left mb-4 alert alert-info">
          Что бы поменять пароль воспользуйтесь формой ниже. <br>
          Если вы не помните свой старый пароль, <br> то воспользуйтесь
          <router-link :to="{ name: 'forgot' }">средствами восстановления пароля</router-link>
        </div>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5">
        <div class="alert alert-danger alert-dismissable" v-if="errors">
          <div v-for="item in errors">
            {{item}}
          </div>
        </div>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5">
        <div class="alert alert-warning alert-dismissable" v-if="message">
          <div v-for="item in message">
            <span v-html="item"></span>
          </div>
        </div>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5">
        <div class="alert alert-success alert-dismissable" v-if="success">
          <div v-for="item in success">
            <span v-html="item"></span>
          </div>
        </div>
      </b-col>
    </b-row>

    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5 d-flex">
        <b-button variant="primary" class="form__btn btn btn-lg btn-primary mb-4 mr-3" v-if="message" v-on:click="returnSendMail">Отправить снова</b-button>
        <div v-if="loader2" class="loader mb-4"></div>
      </b-col>
    </b-row>
    <a style='cursor:pointer;text-decoration: underline' v-on:click='changePassword'></a>

    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5">
        <h3 class="h5">Старый пароль <span style="color: #FF0000;">*</span></h3>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5 mb-4">
        <b-form-group class="mb-0">
          <b-form-input type="password" id="old-password"
                        placeholder="Введите старый пароль"
                        class="form-control form-control-lg"
                        v-model="password.oldPassword"></b-form-input>
        </b-form-group>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5">
        <h3 class="h5">Новый пароль <span style="color: #FF0000;">*</span></h3>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5 mb-4">
        <b-form-group class="mb-0">
          <b-form-input type="password" id="new-password"
                        placeholder="Введите новый пароль"
                        class="form-control form-control-lg"
                        v-model="password.newPassword"></b-form-input>
        </b-form-group>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5">
        <h3 class="h5">Подтвердите новый пароль <span style="color: #FF0000;">*</span></h3>
      </b-col>
    </b-row>
    <b-row>
      <b-col class="col-12 col-sm-12  col-md-5 col-lg-5 mb-4">
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
        <b-button variant="primary" class="form__btn btn btn-lg btn-primary mb-4 mr-3" v-on:click="changePassword" :disabled="disabled">Сохранить изменения</b-button>
        <div v-if="loader" class="loader"></div>
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
        message: '',
        success: '',
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
      var queryString = window.location.search;
      var query = {};
      var pairs = (queryString[0] === '?' ? queryString.substr(1) : queryString).split('&');

      for (var i = 0; i < pairs.length; i++) {
        var pair = pairs[i].split('=');
        query[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || '');
      }

      for (var item in query) {
        if (item !== 'hash' && item !== 'email'){
          return false;
        }
      }

      this.loader2 = true;

      const options = {
        method: 'POST',
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('access_token')
        },
        data: {
          hash: query.hash,
          email: query.email,
        },
        url: window.apiHostname + 'changePasswordConfirm',
      };
      axios(options)
        .then(response => {
          if (response.data.status === 'error'){
            this.errors = response.data.data.errors;

          }else if(response.data.status === 'ok'){
            this.success = response.data.data.message;
          }

          this.loader2 = false;
        })
        .catch(e => {
          console.log(e);

          this.loader2 = false;
        });

    },
    methods: {
      changePassword: function (event) {
        event.preventDefault();
        if (this.checkPassword()){
          return false;
        }
        this.errors = '';
        this.message = '';
        this.success = '';
        this.disabled = true;
        this.loader = true;
        const options = {
          method: 'POST',
          headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('access_token')
          },
          data: {
            password: this.password,
          },
          url: window.apiHostname + 'changePassword',
        };
        axios(options)
          .then(response => {
            if (response.data.status === 'error'){
              this.errors = response.data.data.errors;
            }else if(response.data.status === 'message'){
              this.message = response.data.data.message;
              // this.inputsReset();
            }

            this.disabled = false;
            this.loader = false;
          })
          .catch(e => {
            console.log(e);

            this.disabled = false;
            this.loader = false;
          });
      },
      checkPassword(){
        if (!this.password.oldPassword){
          this.errors = ["Поле старый пароль обязательное."];
          return true;
        }
        if (!this.password.newPassword){
          this.errors = ["Поле новый пароль обязательное."];
          return true;
        }
        if (!this.password.newPasswordConfirm){
          this.errors = ["Подтвердите новый пароль."];
          return true;
        }
        if (this.password.newPassword !== this.password.newPasswordConfirm){
          this.errors = ["Пароли не совпадают."];
          return true;
        }
        if (this.password.newPassword === this.password.oldPassword){
          this.errors = ["Новый пароль не отличается от старого, измените новый пароль."];
          return true;
        }
        if(this.password.newPassword.length < 5){
          this.errors = ["Пароль должен быть больше 6 символов."];
          return true;
        }

        if(/^[a-zA-Z0-9- ]*$/.test(this.password.newPassword) == false){
          if(/^[а-яА-Я0-9- ]*$/.test(this.password.newPassword) == false){
            this.errors = ["Пароль не должен содержать специальные символы."];
          } else {
            this.errors = ["Пароль должен содержать только латинские символы."];
          }

          return true;
        }

        if(/^[\S]*$/.test(this.password.newPassword) == false){
          this.errors = ["Пароль не должен содержать пробелы."];
          return true;
        }

        return false;
      },
      inputsReset: function () {
        this.password.newPassword = this.password.oldPassword = this.password.newPasswordConfirm = '';
      },
      returnSendMail(){
        this.loader2 = true;
        this.message = '';
        const options = {
          method: 'POST',
          headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('access_token')
          },
          data: {},
          url: window.apiHostname + 'returnSendMail',
        };
        axios(options)
          .then(response => {
            if (response.data.status === 'error'){
            }else if(response.data.status === 'ok'){
              this.success = response.data.data.message;
            }

            this.loader2 = false;

          })
          .catch(e => {
            console.log(e);
          });
      }
    }
  }
</script>

<style>
</style>
