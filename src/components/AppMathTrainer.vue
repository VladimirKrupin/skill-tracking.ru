<template>
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <!--<img src="./assets/logo.png">-->
          <!--<router-view/>-->
          <start-screen
            v-if="state == 'start'"
            @onStart="onStart"
            @onHistory="showHistory"
          >
          </start-screen>
          <history
            v-else-if="state == 'history'"
            @backBegin="backBegin"
            :history="this.stats.history"
            :success="this.stats.success"
            :errors="this.stats.errors"
          >
          </history>
          <question
            v-else-if="state == 'question'"
            @success="onSuccess"
            @error="onError"
            @prev="prev"
          >
          </question>
          <message
            v-else-if="state == 'message'"
            :text="this.message.msgText"
            :type="this.message.msgType"
            @backBegin="backBegin"
            @getQuestion="getQuestion"
          >
          </message>
          <result-screen v-else-if="state == 'result'"></result-screen>
          <div v-else>Unknown state</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      state: 'start',
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
