<template>
  <div>
    <sign-up></sign-up>
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
    backBegin () {
      this.state = 'start'
    },
    onStart () {
      this.state = 'question'
    },
    prev () {
      this.state = this.prevComponent
      this.currentComponent = this.prevComponent
      this.prevComponent = this.state
    },
    onSuccess (expression, answer, time) {
      this.state = 'message'
      this.message.msgType = 'success'
      this.message.msgText = 'Верно! ' + expression
      this.stats.success++
      this.stats.history.push('( ' + time + ' sec ) ' + expression + ' Верно!')
    },
    onError (expression, answer, time) {
      this.state = 'message'
      this.message.msgType = 'error'
      this.message.msgText = 'ответ ' + answer + ' Не верно! ' + expression
      this.stats.errors++
      this.stats.history.push('( ' + time + ' sec ) ' + expression + ' Не верно! Ваш ответ ' + answer)
    },
    showHistory () {
      this.state = 'history'
    },
    getQuestion () {
      this.state = 'question'
    }
  }
}
</script>

<style>

</style>
