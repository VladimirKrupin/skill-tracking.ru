<template>
  <div class="app flex-row  bg-theme app-container">
    <div class="row w-100 pr-md-4 pl-4 pt-2 pr-sm-0">
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mr-sm-0 mr-md-5" v-for="(item, index) in pages" :key="index">
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
        }
    }
</script>
