<template>
  <div id="app">
    <!--<img src="./assets/logo.png">-->
    <!--<router-view/>-->
    <h1 class="text-header">Math.calculator</h1>
    <start-screen
      v-if="state == 'start'"
      @onStart="onStart"
    >
    </start-screen>
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
      @backBegin="backBegin"
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
      state: 'start',
      message: {
        msgType: '',
        msgText: 'lol'
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
    onSuccess () {
      this.state = 'message'
      this.message.msgType = 'success'
      this.message.msgText = 'Верно!'
    },
    onError (msg) {
      this.state = 'message'
      this.message.msgType = 'error'
      this.message.msgText = 'Не верно! ' + msg
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  width: 500px;
  margin: 0 auto;
  /*margin-top: 60px;*/
}
.text-header {
  font-size: 14px;
  text-align: left;
}.flex-box {
   display: flex;
   justify-content: space-between;
 }
.body {
  background: rgba(0,0,0,.1);
  padding: 20px;
}
.text-header {
  font-size: 25px;
}
.btn {
  padding: 10px 20px;
  background: #49afff;
  border: none;
  box-shadow: 1px 1px 3px rgba(0,0,0,1);
}
</style>
