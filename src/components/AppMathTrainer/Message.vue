<template>
  <div class="box box--style" :class="'box--' + type">
    <h3 class="box__header">{{ text }}</h3>
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

<style>
</style>
