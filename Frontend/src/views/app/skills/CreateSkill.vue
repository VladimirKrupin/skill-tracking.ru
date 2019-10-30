<template>
  <div>
    <return></return>
    <div class="px-4">
        <div class="row bg-white skill-row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 pt-2 ">
                <h1 class="h3 input-margin pl-1 pb-2">{{$lang.app.add}}</h1>
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
                        <h3 class="h5 font-sm">{{$lang.form.icon}}</h3>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col class="mb-4 p-0 col-12">
                        <b-form-group class="mb-0">
                            <div>
                                <b-btn class="icon-btn" v-b-toggle.collapseA>
                                    <div class="icon-closed"><i class="icon-arrow-down text-green"></i></div>
                                </b-btn>
                                <i :class="skill.icon"></i>
                                <b-collapse id="collapseA" class="mt-2">
                                    <b-card class="d-flex flex-nowrap card-body-container">
                                        <label v-on:click="tryIcon(icon)" v-for="(icon,key) in icons" class="mr-2" v-bind:key="key">
                                            <input style="opacity: 0" type="radio" name="skill-icon" :id="icon" :value="icon"><i class="ml-1" :class="icon"></i>
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
                icon: 'icon-fire',
            },
            icons: [
                'icon-fire','icon-user','icon-people','icon-user-female','icon-user-follow',
                'icon-user-following','icon-user-unfollow','icon-login', 'icon-logout','icon-emotsmile','icon-phone',
                'icon-call-end','icon-call-in','icon-call-out','icon-map','icon-location-pin','icon-direction',
                'icon-directions','icon-compass','icon-layers', 'icon-menu','icon-list','icon-options-vertical',
                'icon-options','icon-check','icon-plus','icon-close', 'icon-trophy','icon-screen-smartphone',
                'icon-screen-desktop', 'icon-plane','icon-notebook','icon-mustache','icon-mouse','icon-magnet',
                'icon-energy','icon-disc', 'icon-cursor','icon-cursor-move','icon-chemistry', 'icon-speedometer',
                'icon-shield','icon-screen-tablet','icon-magic-wand','icon-hourglass','icon-graduation','icon-ghost',
                'icon-game-controller','icon-fire','icon-eyeglass', 'icon-envelope-open','icon-envelope-letter',
                'icon-bell','icon-badge','icon-anchor','icon-wallet','icon-vector', 'icon-speech','icon-puzzle',
                'icon-printer', 'icon-present','icon-playlist','icon-pin','icon-picture','icon-handbag',
                'icon-globe-alt','icon-globe', 'icon-folder-alt','icon-folder','icon-film', 'icon-feed','icon-drop',
                'icon-docs','icon-doc','icon-diamond','icon-cup','icon-calculator', 'icon-bubbles','icon-briefcase',
                'icon-book-open', 'icon-basket-loaded','icon-basket','icon-bag','icon-action-undo','icon-action-redo',
                'icon-wrench','icon-umbrella', 'icon-trash','icon-tag','icon-support', 'icon-frame','icon-size-fullscreen',
                'icon-size-actual','icon-shuffle','icon-share','icon-rocket','icon-question', 'icon-pie-chart',
                'icon-pencil','icon-note', 'icon-loop','icon-music-tone-alt','icon-music-tone','icon-earphones-alt',
                'icon-earphones','icon-equalizer','icon-like', 'icon-dislike','icon-control-rewind','icon-control-play',
                'icon-control-pause','icon-control-forward','icon-volume-1','icon-volume-2','icon-volume-off',
                'icon-calendar','icon-bulb', 'icon-chart','icon-ban','icon-bubble', 'icon-camrecorder','icon-camera',
                'icon-cloud-download','icon-cloud-upload','icon-envelope','icon-eye','icon-flag', 'icon-heart',
                'icon-info','icon-key', 'icon-link','icon-lock','icon-lock-open','icon-magnifier','icon-magnifier-add',
                'icon-magnifier-remove','icon-paper-clip', 'icon-paper-plane','icon-power','icon-refresh', 'icon-reload',
                'icon-settings','icon-star','icon-symbol-female','icon-symbol-male','icon-target','icon-credit-card',
                'icon-paypal','icon-social-tumblr','icon-social-twitter', 'icon-social-facebook','icon-social-instagram',
                'icon-social-linkedin','icon-social-pinterest','icon-social-github','icon-social-reddit',
                'icon-social-skype','icon-social-dribbble','icon-social-behance', 'icon-social-foursqare',
                'icon-social-soundcloud','icon-social-spotify','icon-social-stumbleupon','icon-social-youtube',
                'icon-social-dropbox',
            ],
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
          tryIcon: function(icon) {
              this.skill.icon = icon;
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
    .input-margin {
        margin-left: -15px;
    }
</style>