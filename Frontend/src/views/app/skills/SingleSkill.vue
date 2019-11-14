<template>
  <div>
    <return></return>
    <card shadow class="card-profile" body>
      <div class="d-flex justify-content-between align-items-center" slot="header">
        <span class="font-lg font-weight-bold">{{skill.title}}</span>
        <div class="card-header-actions">
          <div class="navbar-small">
            <i class="navbar-icon icon-settings"></i>
            <b-nav-item-dropdown class="" text="" right>
              <b-dropdown-item  :to="'/editSkill/'+skill.web_title">{{$lang.skill.edit}}</b-dropdown-item>
            </b-nav-item-dropdown>
          </div>
        </div>
      </div>

      <write-skill-data></write-skill-data>

      <b-row>
        <b-col sm="5">
          <h4 id="traffic" class="card-title mb-0">Traffic</h4>
          <div class="small text-muted">November 2017</div>
        </b-col>
        <b-col sm="7" class="d-none d-md-block">
          <b-button type="button" variant="primary" class="float-right"><i class="icon-cloud-download"></i></b-button>
          <b-button-toolbar class="float-right" aria-label="Toolbar with buttons group">
            <b-form-radio-group class="mr-3" id="radiosBtn" buttons button-variant="outline-secondary" v-model="selected" name="radiosBtn">
              <b-form-radio class="mx-0" value="Day">Day</b-form-radio>
              <b-form-radio class="mx-0" value="Month">Month</b-form-radio>
              <b-form-radio class="mx-0" value="Year">Year</b-form-radio>
            </b-form-radio-group>
          </b-button-toolbar>
        </b-col>
      </b-row>
      <main-chart-example chartId="main-chart-01" class="chart-wrapper" style="height:300px;margin-top:40px;" height="300"></main-chart-example>
      <div slot="footer">
        <b-row class="text-center">
          <b-col class="mb-sm-2 mb-0">
            <div class="text-muted">Visits</div>
            <strong>29.703 Users (40%)</strong>
            <b-progress height={} class="progress-xs mt-2" :precision="1" variant="success" :value="40"></b-progress>
          </b-col>
          <b-col class="mb-sm-2 mb-0 d-md-down-none">
            <div class="text-muted">Unique</div>
            <strong>24.093 Users (20%)</strong>
            <b-progress height={} class="progress-xs mt-2" :precision="1" variant="info" :value="20"></b-progress>
          </b-col>
          <b-col class="mb-sm-2 mb-0">
            <div class="text-muted">Pageviews</div>
            <strong>78.706 Views (60%)</strong>
            <b-progress height={} class="progress-xs mt-2" :precision="1" variant="warning" :value="60"></b-progress>
          </b-col>
          <b-col class="mb-sm-2 mb-0">
            <div class="text-muted">New Users</div>
            <strong>22.123 Users (80%)</strong>
            <b-progress height={} class="progress-xs mt-2" :precision="1" variant="danger" :value="80"></b-progress>
          </b-col>
          <b-col class="mb-sm-2 mb-0 d-md-down-none">
            <div class="text-muted">Bounce Rate</div>
            <strong>Average Rate (40.15%)</strong>
            <b-progress height={} class="progress-xs mt-2" :precision="1" :value="40"></b-progress>
          </b-col>
        </b-row>
      </div>

    </card>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import WriteSkillData from "../../parts/Skill/WriteSkillData.vue";
  import Return from "../../parts/ReturnBack.vue";
  import MainChartExample from '../dashboard/MainChartExample'
    export default {
      name: 'SingleSkill',
      components: {
        Return,
        MainChartExample,
        WriteSkillData
      },
      computed: {
        ...mapGetters('skills', {
          skills: 'skills',
          // skillsData: 'skillsData',
        })
      },
      data() {
        return {
          skill: false,
          selected: 'Month',
        };
      },
      methods:{
      },
      mounted() {
        this.skill = this.getSkill(this.skills);
      },
      created(){
      }
    }
</script>
<style>
  .navbar-small {
    position: relative;
  }
  .navbar-icon {
    position: absolute;
    top:30%;
  }
</style>