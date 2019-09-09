<template>
  <div class="app flex-row align-items-center bg-theme">
    <ReturnLk></ReturnLk>
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="4">
          <b-form>
            <b-row>
              <b-col class="text-center">
                <!--<img src="/img/brand/logo-min.svg" alt="logo" class="form__img mb-3">-->
                Skill Tracking
              </b-col>
            </b-row>
            <h3 class="text-center mb-3">Регистация</h3>
            <p class="text-center mb-3">Введите свой E-mail и мы отправим вам ссылку. Пройдите по ней и вы сразу зарегистрируетесь на сайте.</p>
            <b-row>
              <b-col>
                <b-input-group class="mb-3">
                  <b-form-input v-model="email" type="email" class="form-control-lg" placeholder="E-mail" autocomplete="email" />
                </b-input-group>
              </b-col>
            </b-row>
            <div class="alert alert-danger alert-dismissable" v-if="error">
              {{error}}
            </div>
            <div class="alert alert-success alert-dismissable" v-if="success">
              {{success}}
            </div>
            <b-row class="flex-row align-items-center mb-2">
              <b-col cols="6" class="flex-row">
                <b-button to="/login" variant="link" class="px-0 form__forget">Войти на сайт</b-button>
              </b-col>
            </b-row>
            <b-row>
              <b-col cols="12" class="text-center mb-3">
                <b-button v-on:click="registration" variant="primary" class="form__btn btn btn-lg btn-primary btn-block">Зарегистрироваться</b-button>
              </b-col>
            </b-row>
            <Signature></Signature>
          </b-form>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import ReturnLk from '../static/ReturnLk'
  import Signature from '../static/Signature'

  export default {
    components: {
      ReturnLk,
      Signature
    },
    name: 'ForgotPassword',
    data() {
      return {
        error: '',
        success: '',
        email: '',
        resendmail: '',
      };
    },
    methods: {
      registration: function (event) {
        event.preventDefault();
        this.error = '';
        this.success = '';
        const options = {
          method: 'POST',
          headers: {},
          data: {
            email: this.email,
          },
          url: this.apiHost + '/registration',
        };
        axios(options)
          .then(response => {

          })
          .catch(e => {
            console.log(e);
          });
      },
    },
    mounted: function () {

    }
  }
</script>

<style>
  .form__img {
    width: 70px;
    height: 70px;
  }

  .form__btn {
    background-color: #007bff;
  }

  .form__forget {
    color: #007bff;
  }

  .link {
    color: #007bff;
  }

</style>
