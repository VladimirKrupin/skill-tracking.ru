<template>
  <div class="body">
    <h3 class="text-header">{{ text }}</h3>
    <button class="btn btn--yellow"
            @click="$emit('backBegin')"
    >
      Попробовать еще раз?
    </button>
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
</style>
