<template>
  <div class="box box--style">
    <div class="history">
      <h3>История вопросов</h3>
      <p v-if="history == ''">Ваша история пуста</p>
      <p v-else v-for="item in history" v-bind:key="item">
        {{ item }}
      </p>
    </div>
    <div class="history-total">
    Ошибок: {{ errors }}<br>
    Правильных ответов: {{ success }}
    </div>
    <span class="history-btn" @click="$emit('backBegin')" >Back to start screen</span>
  </div>
</template>

<script>
export default {
  data () {
    return {
      result: 0
    }
  },
  props: ['success', 'errors', 'history']
}
</script>

<style scoped>
  .body {
    text-align: left;
    position: relative;
  }
  .history-btn {
    cursor: pointer;
    border-bottom: 1px dotted #222;
    position: absolute;
    right: 20px;
    top: 20px;
  }
  .history-btn:hover {
    border-bottom: 0;
  }
</style>
