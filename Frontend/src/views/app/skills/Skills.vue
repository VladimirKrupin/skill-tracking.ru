<template>
  <div class="app flex-row align-items-center bg-theme app-container">
        <div class="row col-12 skill-container">
          <div class="col-sm-6 col-md-6 col-lg-4 skill-container" v-for="(item, index) in skills" :key="index">
            <div class="card" :class="item.bg">
              <router-link :to="'skills/'+item.title" class="text-muted card-link">
                <div class="card-body">
                  <div class="h1 text-right mb-4 text-white">
                    <i :class="item.icon"></i>
                  </div>
                  <div class="card-padding  text-center">
                    <div class="h1 mb-3 text-white">{{item.title}}</div>
                    <small class="text-uppercase text-white">{{item.description}}</small>
                  </div>
                </div>
              </router-link>
            </div>
          </div>
        </div>
  </div>

</template>

<script>
  import { mapGetters } from 'vuex'
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
      }
    }
</script>
<style>
  .card-padding {
    padding: 30px 20px 70px 20px;
    text-align: center;
  }
  @media (max-width: 768px) {
    .skill-container {
      padding-right: 0 !important;
    }
  }
</style>