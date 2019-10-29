<template>
  <div>
    <return></return>
    <div class="px-4">
        <div class="row bg-white skill-row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 pt-5 ">
                <b-row>
                    <b-col class="pl-1">
                        <h3 class="h5 font-sm">{{$lang.form.name}}</h3>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="mb-4 p-0">
                        <b-form-group class="mb-0">
                            <b-form-input type="text" id="skill-name"
                                          v-bind:class="validInput(err.name)"
                                          :placeholder=$lang.form.name
                                          class="form-control form-control-lg"
                                          v-model="skill.name"></b-form-input>

                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="pl-1">
                        <h3 class="h5 font-sm">{{$lang.form.description}}</h3>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="mb-4 p-0">
                        <b-form-group class="mb-0">
                            <b-form-input type="text" id="skill-description"
                                          v-bind:class="validInput(err.description)"
                                          :placeholder=$lang.form.description
                                          class="form-control form-control-lg"
                                          v-model="skill.description"></b-form-input>

                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="pl-1">
                        <h3 class="h5 font-sm">{{$lang.profile.icon}}</h3>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="mb-4 p-0 col-12">
                        <b-form-group class="mb-0">
<!--                            <b-form-select id="basicSelect"-->
<!--                                           :plain="true"-->
<!--                                           :options="skillIcons"-->
<!--                                           :value=lang-->
<!--                                           v-model="skill.icon"-->
<!--                            >-->
<!--                            </b-form-select>-->
                                    <div slot="header">
                                        <i class="fa fa-align-justify"></i><strong> Collapse </strong> <small>multiple elements</small>
                                    </div>
                                    <div>
                                        <!-- Single button triggers two b-collapse components -->
                                        <b-btn class="icon-btn" v-b-toggle.collapseA.collapseB>
                                            <div class="icon-closed"><i class=" text-green" :class="skill.icon"></i></div>
                                        </b-btn>
                                        <i class="icon-book-open ml-1"></i>

                                        <!-- elements to collapse -->
                                        <b-collapse id="collapseA" class="mt-2">
                                            <b-card class="d-flex flex-nowrap card-body-container">
                                                <label class="mr-2">
                                                    <input type="radio" name="skill-icon" id="icon-book-open" value="icon-book-open"><i class="icon-book-open ml-1"></i>
                                                </label>
                                                <label>
                                                    <input checked="checked" type="radio" name="skill-icon" id="icon-fire" value="icon-fire"><i class="icon-fire ml-1"></i>
                                                </label>
                                            </b-card>
                                        </b-collapse>
                                    </div>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <div class="d-flex">
                        <b-button  variant="outline-primary" class="mb-4 mr-3" v-on:click="saveSkill()" :disabled="disabled">{{$lang.form.save_changes}}<div v-if="loader" class="loader loader-btn"></div></b-button>
                    </div>
                </b-row>
                <b-row>
                    <b-col class="p-0">
                        <div v-html="errors" class="alert alert-danger alert-dismissable text-dark" v-if="errors">
                        </div>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="p-0">
                        <div class="alert alert-success alert-dismissable text-dark" v-if="success">
                            {{$lang.form.success}}
                        </div>
                    </b-col>
                </b-row>
            </div>
        </div>
    </div>
  </div>

</template>

<script>
  import Return from "../../parts/ReturnBack.vue";
  import axios from 'axios';
    export default {
      name: 'CreateSkill',
      components: {
        Return,
      },
      computed: {
      },
      data() {
        return {
            skill: {
                name: '',
                description: '',
                icon: 'icon-arrow-down',
            },
            err: {
                name:false,
                description:false,
            },
            errors: false,
            success: false,
            loader: false,
            disabled: false,
        };
      },
      methods:{
          saveSkill: function () {
              this.valid();
              if (!this.validCheck()){return false;}
              this.errors = '';
              this.loader = true;
              this.disabled = true;
              this.success = false;
              const options = {
                  method: 'POST',
                  headers: this.defaultHeaders,
                  data: this.userData,
                  url: this.apiHost+'/api/saveSkill/',
              };
              axios(options)
                  .then(response => {
                      this.loader = false;
                      this.disabled = false;
                      this.success = true;
                      this.$store.dispatch('profile/saveSkill');
                      this.checkChangeSettings();
                  })
                  .catch(error => {
                      if (error.response !== undefined){
                          let err = this.err;
                          let errors = this.errors;
                          Object.keys(error.response.data).map(function(objectKey, index) {
                              err[objectKey] = true;
                              errors += error.response.data[objectKey]+"<br>";
                          });
                          this.errors = errors;
                      }
                      this.loader = false;
                      this.disabled = false;
                  });
          },
          valid: function() {
              this.err.name=(this.skill.name)?!this.vStr(this.skill.name):true;
              this.err.description=(this.skill.description)?!this.vStr(this.skill.description):false;
          },
          validCheck: function() {
              let err = this.err;
              let res = true;
              Object.keys(err).map(function(objectKey, index) {
                  if (err[objectKey] === true){
                      res = false;
                  }
              });
              return res;
          },
      },
      mounted() {
      },
      created(){
      }
    }
</script>
<style type="scss">
    .skill-row {
        padding: 1.25rem;
    }
    .icon-btn.btn-secondary {
        background: transparent;
        outline: none;
    }
    .icon-btn.btn-secondary:hover {
        background-color: transparent;
    }
    .icon-btn.btn-secondary:focus {
            box-shadow: none;
    }
    .text-green {
        color: #1ab718;
    }
    .card-body-container .card-body {
        padding: .5rem;
    }
</style>