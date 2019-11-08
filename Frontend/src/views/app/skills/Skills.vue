<template>
  <div>
    <return></return>
      <div class="row pr-4 pl-4">
        <b-card class="col-xl-3 col-lg-5 col-md-5 col-sm-5 mr-sm-0 mr-md-5" :class="item.color" v-for="(item, index) in skills" :key="index">
          <router-link :to="'skills/'+item.web_title" class="text-muted card-link">
            <b-card-body class="pb-0">
              <b-dropdown class="float-right" variant="transparent p-0" right>
                <template slot="button-content">
                  <i :class="item.icon"></i>
                </template>
                <b-dropdown-item disabled>{{$lang.skill.fin_in}}</b-dropdown-item>
                <b-dropdown-item  :to="'/editSkill/'+item.web_title">{{$lang.skill.edit}}</b-dropdown-item>
                <b-dropdown-item disabled>{{$lang.skill.copy}}</b-dropdown-item>
                <b-dropdown-item disabled>{{$lang.skill.share}}</b-dropdown-item>
              </b-dropdown>
              <h4 class="mb-0 text-white">{{item.title}}</h4>
              <p class="text-white">{{item.description}}</p>
            </b-card-body>
            </router-link>

          <card-line1-chart-example v-if="item.type === 1" :bg="item.color.replace('bg-', '')" chartId="card-chart-01" class="chart-wrapper px-3" :height="70"/>
          <card-line2-chart-example v-if="item.type === 2" :bg="item.color.replace('bg-', '')" chartId="card-chart-01" class="chart-wrapper px-3" :height="70"/>
          <card-line3-chart-example v-if="item.type === 3" :bg="item.color.replace('bg-', '')" chartId="card-chart-01" class="chart-wrapper px-3" :height="70"/>
          <card-bar-chart-example v-if="item.type === 4" :bg="item.color.replace('bg-', '')" chartId="card-chart-01" class="chart-wrapper px-3" :height="70"/>
        </b-card>
        <div class="add-skill-container col-xl-3 col-lg-5 col-md-5 col-sm-5 mr-sm-0 mr-md-5 d-flex justify-content-center align-items-center">
          <router-link  class="add-skill" :to="'/skills/createSkill'"></router-link>
        </div>
      </div>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import Return from "../../parts/ReturnBack.vue";
  import CardLine1ChartExample from '../dashboard/CardLine1ChartExample'
  import CardLine2ChartExample from '../dashboard/CardLine2ChartExample'
  import CardLine3ChartExample from '../dashboard/CardLine3ChartExample'
  import CardBarChartExample from '../dashboard/CardBarChartExample'
  export default {
    name: 'Skills',
    computed: {
      ...mapGetters('skills', {
        skills: 'skills',
      })
    },
    data() {
      return {
      };
    },
    methods:{
    },
    mounted() {
      this.$store.dispatch('skills/getSkills');
    },
    components: {
      Return,
      CardLine1ChartExample,
      CardLine2ChartExample,
      CardLine3ChartExample,
      CardBarChartExample,
    }
  }
</script>
<style lang="scss">
  @media (max-width: 768px) {
    .skill-container {
      padding-right: 0 !important;
    }
  }
  .card-height {
    height:115px;
  }
  .add-skill-container {
    margin-bottom: 1.5rem;
  }
  .add-skill {
    width: 100px;
    position: relative;
    opacity: .7;
    /*margin-top: 60px;*/
    height: 100px;
    cursor: pointer;
  }
  .add-skill:hover, .add-skill:active {
    /*opacity: 1;*/
    transition: 1s;
    margin-top: -2px;
  }
  .add-skill::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 4px;
      background: #00ff00;
      top: calc(50% - 2px);
  }
  .add-skill::before {
      content: '';
      position: absolute;
      transform: rotate(90deg);
      width: 100%;
      height: 4px;
      background: #00ff00;
      top: calc(50% - 2px);
  }

  .add-skill-text {
    position: absolute;
  }
</style>