<template>
  <div>
    <b-col class="col-sm-12 col-12 col-md-5 col-lg-5 pt-2 arrow-back">
      <router-link class="" to="/skills"><span class="icon-arrow-left"></span> Вернуться</router-link>
    </b-col>
    <div class="app flex-row align-items-center bg-theme app-container">
    </div>
  </div>

</template>

<script>
    export default {
      name: 'SingleSkill',
      computed: {
      },
      data() {
        return {
        };
      },
      methods:{
      },
      mounted() {
      },
      created(){
          this.$route.meta.label = this.$route.params.id;
      }
    }
</script>
<style>
  .arrow-back {
    margin-top: -30px;
  }
  @media (max-width: 768px) {
    .arrow-back {
      margin-top: 10px;
    }
  }
</style>