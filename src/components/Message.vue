<template>
  <div class="body" :class="'body--' + type">
    <h3 class="text-header">{{ text }}</h3>
    <div class="flex">
      <button class="btn btn--yellow"
              @click="$emit('backBegin')"
      >
        Back to start
      </button>
      <button class="btn btn--yellow"
              @click="$emit('getQuestion')"
      >
        Следующий вопрос
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ['type', 'text']
}
</script>

<style scoped>
  .btn--yellow {
    background: #fdffa3;
  }
  .body {
    text-align: right;
  }
  .body--error {
    background: #ff9b7f;
  }
  .body--success {
    background: #b6ff9d;
  }
</style>
