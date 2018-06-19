<template>
  <div>
    <main-header
      @signin="signin"
      @signup="signup"
    ></main-header>
    <div class="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-sm-8">
            <sign-in
              v-if="state === 'signin'"
            ></sign-in>
            <sign-up
              v-if="state === 'signup'"
            ></sign-up>
          </div>
        </div>
      </div>
    </div>
    <main-footer></main-footer>
  </div>
</template>

<script>
export default {
  data () {
    return {
      state: 'signup',
      title: 'Math.trainer',
      stats: {
        errors: 0,
        success: 0,
        attempts: 0,
        history: []
      },
      message: {
        msgType: '',
        msgText: ''
      }
    }
  },
  methods: {
    signin () {
      this.state = 'signin'
    },
    signup () {
      this.state = 'signup'
    }
  }
}
</script>

<style>

</style>
