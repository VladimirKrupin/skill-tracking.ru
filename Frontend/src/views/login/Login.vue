<template>
  <div class="app flex-row align-items-center bg-theme">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="4">
          <b-form>
            <b-row>
              <b-col class="text-center">
                <img src="/img/brand/logo-min.png" width="100px" height="100px" alt="logo" class="form__img mb-3">
              </b-col>
            </b-row>
            <h3 class="text-center mb-3">Войти в личный кабинет</h3>
            <b-input-group class="mb-3">
              <b-form-input v-model="userData.email" type="email" class="form-control-lg" placeholder="E-mail" autocomplete="email" />
            </b-input-group>
            <b-input-group class="mb-3">
              <b-form-input v-model="userData.password" type="password" class="form-control-lg" placeholder="Пароль" autocomplete="current-password" />
            </b-input-group>
            <div class="alert alert-danger alert-dismissable" v-if="errors">
              <div v-for="item in errors">
                {{item}}
              </div>
            </div>
            <b-row class="flex-row align-items-center mb-2">
              <b-col cols="12" class="text-right">
                <b-button to="/forgot-password" variant="link" class="px-0 form__forget">Забыли пароль?</b-button>
              </b-col>
            </b-row>
            <b-row>
              <b-col cols="12" class="text-center mb-3">
                <b-button v-on:click="autorization" variant="primary" class="form__btn btn btn-lg btn-primary btn-block">Войти</b-button>
              </b-col>
            </b-row>
            <b-row>
              <b-col cols="12">
                <p class="mt-3 mb-3 text-muted text-center">
                  &#9400; 2019 skill-tracking официальный сайт.
                </p>
              </b-col>
            </b-row>
          </b-form>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
    import axios from 'axios';

    export default {
      components: {
      },
      data() {
        return {
          errors: '',
          userData: {
            "email": '',
            "password": ''
          },
          countVar: '',
        };
      },
      name: 'Login',
      mounted: function () {

      },
      methods: {
        autorization: function (event) {
          event.preventDefault();
          this.error = '';
          const options = {
            method: 'POST',
            headers: {
            },
            data: {
              email: this.userData.email,
              password: this.userData.password,
            },

            url: '1111',
          };
          axios(options)
            .then(response => {
              if (response.data.status === 'error'){
                this.errors = response.data.data.errors;
                return false;
              }else if(response.data.status === 'ok'){
                localStorage.setItem('access_token', response.data.data.token);

                this.$router.push({ name: 'Files' });
              }
            })
            .catch(e => {
              console.log(e);
            });
        }
      }
    }
</script>

<style scoped>
  .form__btn {
    background-color: #007bff;
  }

  .form__forget {
    color: #007bff;
  }

  .link {
    color: #007bff;
  }

  .bg-theme {
    background-color: #f6f7f7;
  }
</style>
