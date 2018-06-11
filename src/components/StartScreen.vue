<template>
  <div class="body">
    <h3 class="text-header">Are you ready?</h3>
    <button class="btn" @click="$emit('onStart')" >start</button>
  </div>
</template>

<script>
</script>

<style scoped>
  .btn {
    padding: 10px 20px;
    background: #49ff98;
    border: none;
    box-shadow: 1px 1px 3px rgba(0,0,0,1);
  }
</style>
