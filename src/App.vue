<template>
  <div id="app">
    <!--<img src="./assets/logo.png">-->
    <!--<router-view/>-->
    <sign-up v-if="state == 'signup'">
    </sign-up>
    <start-screen
      v-else-if="state == 'start'"
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
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  /*text-align: center;*/
  color: #2c3e50;
  width: 500px;
  margin: 0 auto;
  /*margin-top: 60px;*/
}
/*.text-header {*/
  /*font-size: 14px;*/
  /*text-align: left;*/
/*}.flex-box {*/
   /*display: flex;*/
   /*justify-content: space-between;*/
 /*}*/
/*.body {*/
  /*background: rgba(0,0,0,.1);*/
  /*padding: 20px;*/
/*}*/
/*.text-header {*/
  /*font-size: 25px;*/
/*}*/
/*.btn {*/
  /*padding: 10px 20px;*/
  /*background: #49afff;*/
  /*border: none;*/
  /*box-shadow: 1px 1px 3px rgba(0,0,0,1);*/
/*}*/
  /*.flex {*/
    /*display: flex;*/
    /*justify-content: space-between;*/
  /*}*/
</style>
