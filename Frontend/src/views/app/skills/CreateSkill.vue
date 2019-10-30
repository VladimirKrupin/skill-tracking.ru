<template>
  <div>
    <return></return>
      <card shadow class="card-profile" body>
        <h1 class="h3 input-margin pl-1 pb-2">{{$lang.app.add}}</h1>
        <b-row class="p-0 m-0">
            <b-col class="pl-1">
                <h3 class="h5 font-sm">{{$lang.form.name}}</h3>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="mb-4 p-0 col-xl-2 col-lg-4 col-md-4 col-sm-12">
                <b-form-group class="mb-0">
                    <b-form-input type="text" id="skill-name"
                                  v-bind:class="validInput(err.name)"
                                  :placeholder=$lang.form.name_text
                                  class="form-control form-control-lg"
                                  v-model="skill.name"></b-form-input>

                </b-form-group>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="pl-1">
                <h3 class="h5 font-sm">{{$lang.form.description}}</h3>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="mb-4 p-0 col-xl-2 col-lg-4 col-md-4 col-sm-12">
                <b-form-group class="mb-0">
                    <b-form-input type="text" id="skill-description"
                                  v-bind:class="validInput(err.description)"
                                  :placeholder=$lang.form.description
                                  class="form-control form-control-lg"
                                  v-model="skill.description"></b-form-input>

                </b-form-group>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="pl-1">
                <h3 class="h5 font-sm">{{$lang.form.icon}}</h3>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="mb-4 p-0 col-xl-4 col-lg-6 col-md-12 col-sm-12">
                <b-form-group class="mb-0">
                    <div>
                        <b-btn class="icon-btn" v-b-toggle.collapseA>
                            <div class="icon-closed"><i class="icon-arrow-down text-green"></i></div>
                        </b-btn>
                        <i :class="skill.icon"></i>
                        <b-collapse id="collapseA" class="mt-2">
                            <b-card class="d-flex flex-nowrap card-body-container">
                                <label v-on:click="tryIcon(icon)" v-for="(icon,key) in icons" class="mr-2" v-bind:key="key">
                                    <input style="display: none" type="radio" name="skill-icon" :id="icon" :value="icon"><i class="ml-1" :class="icon"></i>
                                </label>
                            </b-card>
                        </b-collapse>
                    </div>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="pl-1 ">
                <h3 class="h5 font-sm">{{$lang.form.color}}</h3>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="mb-4 p-0 col-xl-4 col-lg-6 col-md-12 col-sm-12">
                <b-form-group class="mb-0">
                    <div>
                        <div class="d-flex no-wrap">
                            <b-btn class="icon-btn" v-b-toggle.collapseB>
                                <div class="icon-closed"><i class="icon-arrow-down text-green"></i></div>
                            </b-btn>
                            <div class="color-block ml-1" :class="skill.color"></div>
                        </div>
                        <b-collapse id="collapseB" class="mt-2">
                            <b-card class="d-flex flex-nowrap card-body-container">
                                <label v-on:click="tryColor(color)" v-for="(color,key) in colors" class="mr-2" v-bind:key="key">
                                    <input style="opacity: 0" type="radio" name="skill-icon" :id="color" :value="color"><span class="color-block ml-1" :class="color"></span>
                                </label>
                            </b-card>
                        </b-collapse>
                    </div>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="pl-1 pb-2 pt-2">
                <h3 class="h4">{{$lang.form.tracking}} <span class="font-sm">{{$lang.form.tracking_name_additional}}</span></h3>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="pl-1 col-xl-2 col-lg-3 col-md-6 col-sm-6 ">
                <h3 class="h4 font-sm">{{$lang.form.tracking_name}}</h3>
            </b-col>
            <b-col class="pl-1 ml-3 offset-1 col-sm-2">
                <h3 class="h4 font-sm">{{$lang.form.units}}</h3>
            </b-col>
        </b-row>
        <div v-for="(point,key) in skill.points" v-bind:key="key">
            <b-row class="p-0 m-0">
                <b-col class="mb-4 p-0 col-xl-2 col-lg-3 col-md-6 col-sm-5 ">
                    <b-form-group class="mb-0">
                        <b-form-input type="text"
                                      v-bind:class="validInput(err.points[key])"
                                      :placeholder=$lang.form.tracking_name_text
                                      class="form-control form-control-lg"
                                      v-model="point.name"></b-form-input>

                    </b-form-group>
                </b-col>
                <b-col class="mb-4 p-0 ml-3 offset-1 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                    <b-form-select id="basicSelect"
                                   class="h-100"
                                   :plain="true"
                                   :options="units"
                                   value="hours"
                                   v-model="point.units"
                    >
                    </b-form-select>
                </b-col>
            </b-row>
        </div>
        <b-row>
            <b-col>
                <div class="add-skill-container d-flex justify-content-start align-items-center mb-5">
                    <div v-on:click="addSkill()" class="add-skill add-skill-small"></div>
                </div>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <div class="d-flex">
                <b-button  variant="outline-primary" class="mb-4 mr-3" v-on:click="saveSkill()" :disabled="disabled">{{$lang.form.save_changes}}<div v-if="loader" class="loader loader-btn"></div></b-button>
            </div>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="p-0">
                <div v-html="errors" class="alert alert-danger alert-dismissable text-dark" v-if="errors">
                </div>
            </b-col>
        </b-row>

        <b-row class="p-0 m-0">
            <b-col class="p-0">
                <div class="alert alert-success alert-dismissable text-dark" v-if="success">
                    {{$lang.form.success_create_skill}}
                </div>
            </b-col>
        </b-row>
      </card>
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
                color: 'bg-success',
                points: [
                    {
                        name: '',
                        units: this.getUnits()[0],
                    }
                ],
            },
            units: this.getUnits(),
            colors: [
                'bg-success','bg-info','bg-warning','bg-danger','bg-secondary','bg-primary','bg-dark'
            ],
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
                points: [false],
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
                  data: this.skill,
                  url: this.apiHost+'/api/saveSkill/',
              };

              axios(options)
                  .then(response => {
                      this.loader = false;
                      this.disabled = false;
                      this.success = true;
                      this.$store.dispatch('profile/saveSkill');
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
              let points = this.err.points;
              this.err.points = [];
              let points_values = this.skill.points;
              let vFunc = this.vStr;
              Object.keys(points).map(function(objectKey, index) {
                  points[objectKey] = (points_values[objectKey].name)?!vFunc(points_values[objectKey].name):true;
              });
              this.err.points = points;
          },
          validCheck: function() {
              let err = this.err;
              let points = this.err.points;
              let res = true;
              Object.keys(err).map(function(objectKey, index) {
                  if (err[objectKey] === true){
                      res = false;
                  }
              });
              Object.keys(points).map(function(objectKey, index) {
                  if (points[objectKey] === true){
                      res = false;
                  }
              });
              return res;
          },
          tryIcon: function(icon) {
              this.skill.icon = icon;
          },
          tryColor: function(color) {
              this.skill.color = color;
          },
          addSkill: function () {
              this.skill.points.push({
                  name: '',
                  units: 'time',
              });

              this.err.points.push(false);
          },
          getUnits(){
              console.log(this.lang);
              console.log(this.$lang);
              return [this.$lang.form.time,this.$lang.form.quantity]
          }

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
        margin-left: 0;
    }
    .color-block {
        width: 30px;
        height: 30px;
        display: block;
    }
    .add-skill-small {
        position: relative;
        width: 50px;
        height: 50px;
        color: #00ff00;
        cursor: pointer;
    }
    .add-skill.add-skill-small::after {
        width: 100%;
        left:25%;
        content: '';
        position: absolute;
        height: 4px;
        background: #00ff00;
        top: calc(50% - 2px);
    }
    .add-skill.add-skill-small::before {
        width: 100%;
        left:25%;
        content: '';
        position: absolute;
        transform: rotate(90deg);
        height: 4px;
        background: #00ff00;
        top: calc(50% - 2px);
    }
    .add-skill.add-skill-small:hover {
        margin-top: 0;
    }
</style>