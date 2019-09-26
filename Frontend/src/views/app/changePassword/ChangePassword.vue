<template>
<div>
  <card shadow class="card-profile" body>
      <b-row>
        <b-col class="col-md-5 col-lg-5">
          <h1 class="h3 my-4">{{$lang.change.name}}</h1>
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
        <b-col class="pl-1">
          <h3 class="h5 font-sm">{{$lang.change.old_pass}} <span style="color: #FF0000;">*</span></h3>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="mb-4 p-0">
          <b-form-group class="mb-0">
            <b-form-input type="password" id="old-password"
                          :placeholder=$lang.change.write_old_pass
                          class="form-control form-control-lg"
                          v-model="password.oldPassword"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="pl-1">
          <h3 class="h5 font-sm">{{$lang.change.new_pass}} <span style="color: #FF0000;">*</span></h3>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="mb-4 p-0">
          <b-form-group class="mb-0">
            <b-form-input type="password" id="new-password"
                          :placeholder=$lang.change.write_new_pass
                          class="form-control form-control-lg"
                          v-model="password.newPassword"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="pl-1">
          <h3 class="h5 font-sm">{{$lang.change.confirm_pass}} <span style="color: #FF0000;">*</span></h3>
        </b-col>
      </b-row>
      <b-row class="col-xl-2 col-lg-4 col-md-6 col-sm-12 p-0 m-0">
        <b-col class="mb-4 p-0">
          <b-form-group class="mb-0">
            <b-form-input type="password" id="confirm-password"
                          :placeholder=$lang.change.confirm_pass
                          class="form-control form-control-lg"
                          v-model="password.newPasswordConfirm"></b-form-input>
          </b-form-group>
        </b-col>
      </b-row>
      <b-row>
        <b-col class="col-12 col-sm-12  col-md-5 col-lg-5 d-flex">
          <b-button variant="outline-primary" class="mb-4 mr-3" v-on:click="changePassword" :disabled="disabled">{{$lang.change.save_changes}}<div v-if="loader" class="loader loader-btn"></div></b-button>
        </b-col>
      </b-row>

      <b-row>
        <b-col class="col-12">
          <div role="alert" aria-live="polite" aria-atomic="true" class="text-left mb-4 text-dark">
              {{$lang.change.text1}} <br>
              {{$lang.change.text2}}
            <router-link :to="{ name: 'forgot' }">{{$lang.change.link}}</router-link>
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
          this.errors = this.$lang.change.error1;
          return true;
        }
        if (!this.password.newPassword){
          this.errors = this.$lang.change.error2;
          return true;
        }
        if (!this.password.newPasswordConfirm){
          this.errors = this.$lang.change.error3;
          return true;
        }
        if (this.password.newPassword !== this.password.newPasswordConfirm){
          this.errors = this.$lang.change.error4;
          return true;
        }
        if (this.password.newPassword === this.password.oldPassword){
          this.errors = this.$lang.change.error5;
          return true;
        }
        if(this.password.newPassword.length < 5){
          this.errors = this.$lang.change.error6;
          return true;
        }

        if(/^[a-zA-Z0-9- ]*$/.test(this.password.newPassword) == false){
          if(/^[а-яА-Я0-9- ]*$/.test(this.password.newPassword) == false){
            this.errors = this.$lang.change.error7;
          } else {
            this.errors = this.$lang.change.error8;
          }

          return true;
        }

        if(/^[\S]*$/.test(this.password.newPassword) == false){
          this.errors = this.$lang.change.error9;
          return true;
        }

        return false;
      },
    }
  }
</script>

<style>
</style>
