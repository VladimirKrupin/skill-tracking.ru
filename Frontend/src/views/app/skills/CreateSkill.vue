<template>
  <div>
    <return></return>
      <card shadow class="card-profile" body>
        <h1 class="h3 input-margin pl-1 pb-2">{{getTitle()}}</h1>
          <b-row class="p-0 m-0">
              <b-col class="p-0">
                  <div v-html="errors" class="alert alert-danger alert-dismissable text-dark" v-if="errors">
                  </div>
              </b-col>
          </b-row>
        <b-row class="p-0 m-0">
            <b-col class="pl-1">
                <h3 class="h5 font-sm">{{$lang.form.name}}</h3>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="mb-4 p-0 col-xl-2 col-lg-4 col-md-4 col-sm-12">
                <b-form-group class="mb-0">
                    <b-form-input type="text" id="skill-name"
                                  v-bind:class="validInput(err.title)"
                                  :placeholder=$lang.form.name_text
                                  class="form-control form-control-lg"
                                  v-model="skill.title"
                                  v-on:input="checkTitle(skill.title)"
                    ></b-form-input>

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
            <b-col class="pl-1 ">
                <h3 class="h5 font-sm">{{$lang.form.type}}</h3>
            </b-col>
        </b-row>
        <b-row class="p-0 m-0">
            <b-col class="mb-4 p-0 col-xl-4 col-lg-6 col-md-12 col-sm-12">
                <b-form-group class="mb-0">
                    <div>
                        <div class="d-flex no-wrap">
                            <b-btn style="height: 35px" class="icon-btn" v-b-toggle.collapseC>
                                <div class="icon-closed"><i class="icon-arrow-down text-green"></i></div>
                            </b-btn>
                            <b-col sm="6" lg="6">
                                <b-card no-body class="pt-3 type-card" :class="skill.color">
                                    <card-line1-chart-example v-if="skill.type === 1" :bg="skill.colorGraph" chartId="card-chart-01" class="chart-wrapper px-3" :height="70"/>
                                    <card-line2-chart-example v-if="skill.type === 2" :bg="skill.colorGraph" chartId="card-chart-01" class="chart-wrapper px-3" :height="70"/>
                                    <card-line3-chart-example v-if="skill.type === 3" :bg="skill.colorGraph" chartId="card-chart-01" class="chart-wrapper px-3" :height="70"/>
                                    <card-bar-chart-example v-if="skill.type === 4" :bg="skill.colorGraph" chartId="card-chart-01" class="chart-wrapper px-3" :height="70"/>
                                </b-card>
                            </b-col>
                        </div>

                        <b-collapse id="collapseC" class="mt-2">
                            <b-row class="d-flex no-wrap">
                                <b-col sm="6" lg="6" v-on:click="changeType(1)">
                                    <b-card no-body class="pt-3 bg-success">
                                        <card-line1-chart-example :bg="'success'" chartId="card-chart-01" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
                                    </b-card>
                                </b-col>
                                <b-col sm="6" lg="6">
                                    <b-card no-body class="pt-3 bg-info" v-on:click="changeType(2)">
                                        <card-line2-chart-example :bg="'info'" chartId="card-chart-02" class="chart-wrapper px-3" style="height:70px;" :height="70"/>
                                    </b-card>
                                </b-col>
                                <b-col sm="6" lg="6">
                                    <b-card no-body class="pt-3 bg-warning" v-on:click="changeType(3)">
                                        <card-line3-chart-example :bg="'warning'" chartId="card-chart-03" class="chart-wrapper" style="height:70px;" height="70"/>
                                    </b-card>
                                </b-col>

                                <b-col sm="6" lg="6">
                                    <b-card no-body class="pt-3 bg-danger" v-on:click="changeType(4)">
                                        <card-bar-chart-example :bg="'danger'" chartId="card-chart-04" class="chart-wrapper px-3" style="height:70px;" height="70"/>
                                    </b-card>
                                </b-col>
                            </b-row>
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
        <div v-if="point.active === 1" v-for="(point,key) in skill.points" v-bind:key="key">
            <b-row class="p-0 m-0">
                <b-col class="mb-4 p-0 col-xl-2 col-lg-3 col-md-6 col-sm-5 ">
                    <b-form-group class="mb-0">
                        <b-form-input type="text"
                                      v-bind:class="validInput(err.points[key])"
                                      :placeholder=$lang.form.tracking_name_text
                                      class="form-control form-control-lg"
                                      v-model="point.title"></b-form-input>

                    </b-form-group>
                </b-col>
                <b-col v-if="point.edit === true" class="mb-4 p-0 ml-3 mr-2 offset-1 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                    <b-form-select id="basicSelect"
                                   class="h-100"
                                   :plain="true"
                                   :options="units"
                                   value="hours"
                                   v-model="point.units"
                                   v-on:change="pointHandler(point)"
                    >
                    </b-form-select>
                    <i class="icon-close" v-on:click="removePoint(key,skill.points)"></i>
                </b-col>
                <b-col v-if="point.edit === false" class="font-sm mb-4 p-0 ml-3 mr-2 offset-1 col-sm-2 col-md-2 col-lg-2 col-xl-1">
<!--                    {{$lang.skill.not_available}}-->
                    {{point.units}}
                    <i class="icon-close" v-on:click="removePoint(key,skill.points)"></i>
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
                <div class="alert alert-success alert-dismissable text-dark" v-if="editSuccess">
                    {{$lang.form.success_edit_skill}}
                </div>
            </b-col>
        </b-row>
      </card>
  </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import Return from "../../parts/ReturnBack.vue";
    import axios from 'axios';
    import CardLine1ChartExample from '../dashboard/CardLine1ChartExample'
    import CardLine2ChartExample from '../dashboard/CardLine2ChartExample'
    import CardLine3ChartExample from '../dashboard/CardLine3ChartExample'
    import CardBarChartExample from '../dashboard/CardBarChartExample'

    export default {
      name: 'CreateSkill',
      components: {
        Return,
        CardLine1ChartExample,
        CardLine2ChartExample,
        CardLine3ChartExample,
        CardBarChartExample,
      },
      computed: {
          ...mapGetters('skills', {
              skills: 'skills',
          })
      },
      data() {
        return {
            skill: {
                id: 0,
                title: '',
                description: '',
                icon: 'icon-fire',
                color: 'bg-success',
                colorGraph: 'success',
                type: 1,
                edit: this.getSaveType(),
                points: [
                    {
                        id: 0,
                        title: '',
                        units: this.getUnits(this)[0],
                        unitsType: this.getUnitType(0),
                        edit: true,
                    },
                ],
            },
            units: this.getUnits(this),
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
                title:false,
                description:false,
                points: [false],
            },
            errors: false,
            success: false,
            editSuccess: false,
            loader: false,
            disabled: false,
        };
      },
      methods:{
          getTitle: function(){
              return (this.$route.name === 'EditSkill')?this.$lang.app.edit:this.$lang.app.add;
          },
          saveSkill: function () {
              this.valid();
              if (!this.validCheck()){return false;}
              this.errors = '';
              this.loader = true;
              this.disabled = true;
              this.success = false;
              this.editSuccess = false;
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
                      if (this.skill.edit){
                          this.editSuccess = true;
                      }else {
                          this.success = true;
                      }
                      this.$router.replace(this.$router);
                      this.$router.push({name: 'Skills'});
                  })
                  .catch(error => {
                      if (error.response !== undefined){
                          console.log(error.response);
                          let err = this.err;
                          let errors = this.errors;
                          Object.keys(error.response.data).map(function(objectKey, index) {
                              console.log(error.response.data[objectKey]);
                              err[objectKey] = true;
                              errors += error.response.data[objectKey]+"<br>";
                          });
                          this.errors = errors;
                      }
                      this.loader = false;
                      this.disabled = false;
                  });
          },
          getSaveType: function() { return 'EditSkill' === this.$route.name},
          valid: function() {
              this.err.title=(this.skill.title)?!this.vStr(this.skill.title):true;
              this.err.description=(this.skill.description)?!this.vStr(this.skill.description):false;
              let points = this.err.points;
              this.err.points = [];
              let points_values = this.skill.points;
              let vFunc = this.vStr;
              Object.keys(points).map(function(objectKey, index) {
                  points[objectKey] = (points_values[objectKey].title)?!vFunc(points_values[objectKey].title):true;
              });
              this.err.points = points;
              console.log(this.err.points);
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
              this.skill.colorGraph = color.replace('bg-', '');
          },
          addSkill: function () {
              this.skill.points.push({
                  id: 0,
                  title: '',
                  units: this.getUnits(this)[0],
                  unitsType: this.getUnitType(0),
                  edit: true,
                  active: 1,
              });
              this.err.points.push(false);
          },
          getUnits: ($this) => [$this.$lang.form.time,$this.$lang.form.quantity,$this.$lang.form.pages],
          getUnitType: function(point){
              let type = 'time';
              switch (point) {
                  case 0:
                      type = 'time';
                      break;
                  case 1:
                      type = 'quantity';
                      break;
                  case 2:
                      type = 'pages';
                      break;
              }
              return type;
          },
          // removePoint: (key,points) => points.filter((item,index)=>(key!==index)?item:''),
          removePoint: function (key,points) {
              this.skill.points = points.filter((item,index)=>(key!==index)?item:'');
              // this.err.points = this.err.points.filter((item,index)=>(key!==index)?item:'');
              // delete this.err.points[key];
              this.err.points.splice(key,1);
              // console.log(this.err.points.filter((item,index)=>(key!==index)?item:''));
          },
          changeType: function (index) {
              // console.log(index);
              this.skill.type = index;
          },
          checkTitle: function (title) {
              if (this.skill.edit){
                  return false;
              }
              this.err.title = false;
              this.errors = false;
              const options = {
                  method: 'POST',
                  headers: this.defaultHeaders,
                  data: this.skill,
                  url: this.apiHost+'/api/checkTitle/',
              };

              axios(options)
                  .then(response => {
                  })
                  .catch(error => {
                      if (error.response !== undefined){
                          let err = this.err;
                          let errors = (this.errors)?this.errors:'';
                          Object.keys(error.response.data).map(function(objectKey, index) {
                              err[objectKey] = true;
                              errors += error.response.data[objectKey]+"<br>";
                          });
                          this.errors = errors;
                      }
                  });
          },
          editSkill: function () {
              let skills = this.skills;
              let route = this.$route;
              let skill = this.skill;
              let err = this.err;
              let edit = this.getSaveType();
              if (this.$route.name === 'EditSkill'){
                  err.points = [];
                  Object.keys(skills).map(function(objectKey, index) {
                      if (skills[objectKey].web_title === route.params.id){
                          skill = {
                              id: skills[objectKey].id,
                              title: skills[objectKey].title,
                              description: skills[objectKey].description,
                              icon: skills[objectKey].icon,
                              color: skills[objectKey].color,
                              colorGraph: skills[objectKey].color.replace('bg-', ''),
                              type: skills[objectKey].type,
                              edit: edit,
                              points: [],
                          };
                          let points = skills[objectKey].points;
                          Object.keys(points).map(function(objectKey, index) {
                              skill.points.push({
                                  id: points[objectKey].id,
                                  title: points[objectKey].title,
                                  units: points[objectKey].units,
                                  unitsType: points[objectKey].units_type,
                                  edit: false,
                                  active: points[objectKey].active,
                              });
                              err.points.push(false);
                          });
                      }
                  });
                  this.skill = skill;
              }
          },
          pointHandler: function (point) {
              point.unitsType = this.getPointType(point.units);
          },
          getPointType: function (units) {
              let type = 'time';
              switch (units) {
                  case this.$lang.form.time:
                      type = 'time';
                      break;
                  case this.$lang.form.quantity:
                      type = 'quantity';
                      break;
                  case this.$lang.form.pages:
                      type = 'pages';
                      break;
              }
              return type;
          },
      },
      mounted() {
        this.editSkill();
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
    .icon-close {
        position: absolute;
        right: -20px;
        top:3px;
        color: darkred;
        cursor: pointer;
    }
</style>