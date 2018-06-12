<template>
  <div class="body">
    <h3 class="text-header">Are you ready?</h3>
    <button class="btn" @click="$emit('onStart')" >start</button>
    <span class="history" @click="$emit('onHistory')" >Show history</span>
  </div>
</template>

<script>
</script>

<style scoped>
  .body {
    position: relative;
  }
  .btn {
    padding: 10px 20px;
    background: #49ff98;
    border: none;
    box-shadow: 1px 1px 3px rgba(0,0,0,1);
  }
  .history {
    cursor: pointer;
    border-bottom: 1px dotted #222;
    position: absolute;
    right: 20px;
    top: 20px;
  }
  .history:hover {
    border-bottom: 0;
  }
</style>
