<template>
  <div>
    <return></return>
      <div class="row pr-4 pl-4">
        <b-card class="col-xl-3 col-lg-5 col-md-5 col-sm-5 mr-sm-0 mr-md-5" :class="item.bg" v-for="(item, index) in skills" :key="index">
          <router-link :to="'skills/'+item.title" class="text-muted card-link">
            <b-card-body class="pb-0">
              <b-dropdown class="float-right" variant="transparent p-0" right>
                <template slot="button-content">
                  <i :class="item.icon"></i>
                </template>
                <b-dropdown-item>Action</b-dropdown-item>
                <b-dropdown-item>Another action</b-dropdown-item>
                <b-dropdown-item>Something else here...</b-dropdown-item>
                <b-dropdown-item disabled>Disabled action</b-dropdown-item>
              </b-dropdown>
              <h4 class="mb-0 text-white">{{item.title}}</h4>
              <p class="text-white">{{item.description}}</p>
            </b-card-body>
            </router-link>

          <card-line1-chart-example v-if="item.type === 1" chartId="card-chart-01" class="chart-wrapper px-3 overflow-visible" style="height:115px;" :height="70"/>
          <card-line2-chart-example v-if="item.type === 2" chartId="card-chart-02" class="chart-wrapper px-3 overflow-visible" style="height:115px;" :height="70"/>
        </b-card>
        <div class="add-skill">
        </div>
      </div>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import Return from "../../parts/ReturnBack.vue";
  import CardLine1ChartExample from '../dashboard/CardLine1ChartExample'
  import CardLine2ChartExample from '../dashboard/CardLine2ChartExample'
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
      console.log(this.$route);
      this.$store.dispatch('skills/getSkills');
    },
    components: {
      Return,
      CardLine1ChartExample,
      CardLine2ChartExample,
    }
  }
</script>
<style lang="scss">
  @media (max-width: 768px) {
    .skill-container {
      padding-right: 0 !important;
    }
  }
  .add-skill {
    width: 100px;
    position: relative;
    opacity: .7;
    margin-top: 12%;
    height: 100px;
    cursor: pointer;
  }
  .add-skill:hover, .add-skill:active {
    opacity: 1;
    transition: 1s;
    margin-top: calc("50%-2px");
  }
  .add-skill::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 3px;
      background: #00ff00;
      top: 0;
  }
  .add-skill::before {
      content: '';
      position: absolute;
      transform: rotate(90deg);
      width: 100%;
      height: 3px;
      background: #00ff00;
      top: 0;
  }

  .add-skill-text {
    position: absolute;
  }
</style>