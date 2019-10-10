<template>
  <div class="app flex-row  bg-theme app-container">
    <div class="row col-12 skill-container">
      <div class="col-sm-6 col-md-6 col-lg-4 skill-container" v-for="(item, index) in pages" :key="index">
        <div class="card" :class="item.bg">
          <router-link :to="item.href" class="text-muted card-link">
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
    export default {
        name: 'Main',
        data() {
          return {
            pages: [
              {
                title: this.$lang.nav.main_name,
                bg: 'bg-danger',
                icon: 'icon-home',
                description: this.$lang.nav.main_description,
                href: '/app',
              },
              {
                title: this.$lang.nav.skills_name,
                bg: 'bg-info',
                icon: 'icon-book-open',
                description: this.$lang.nav.skills_description,
                href: '/skills',
              },
              {
                title: this.$lang.nav.statistic_name,
                bg: 'bg-success',
                icon: 'icon-graph',
                description: this.$lang.nav.statistic_description,
                href: '/statistic',
              },
            ]
          };
        },
        mounted() {
          console.log(this.$route);
        }
    }
</script>
