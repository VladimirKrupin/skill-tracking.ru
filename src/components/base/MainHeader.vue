<template>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand navbar-color" href="">Skill Tracking</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" v-on:click="menuClick('Home')" :class="{ active: isActive('Home') }">
            <a class="nav-link" href="/#/" >Home</a>
          </li>
          <li class="nav-item" v-on:click="menuClick('Math')" :class="{ active: isActive('Math') }">
            <a class="nav-link" href="/#/mathtrainer">Math.trainer</a>
          </li>
        </ul>
        <form style="display: none" class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <div style="display: none" class="jumbotron text-center">
      <h1>My First Bootstrap Page</h1>
      <p>Resize this responsive page to see the effect!</p>
    </div>
  </header>
</template>

<script>
export default {
  name: 'MainHeader',
  data () {
    return {
      activeItem: 'Home'
    }
  },
  methods: {
    menuClick (menuItem) {
      this.activeItem = menuItem
    },
    isActive (menuItem) {
      return this.activeItem === menuItem
    }
  }
}
</script>

<style>
</style>
