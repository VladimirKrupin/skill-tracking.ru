<!--suppress ALL -->
<template>
  <div class="body">
    <h3 class="text-header">{{ x }} + {{ y }} = ?</h3>
      <div class="flex-box">
        <button class="btn"
                v-for="number in answer"
                @click="onAnswer(number)"
                v-bind:key="number"
        >
        {{ number }}
        </button>
      </div>
    </div>
</template>

<script>
export default {
  data () {
    return {
      x: randomNumber(100, 500),
      y: randomNumber(100, 500)
    }
  },
  computed: {
    good () {
      return this.x + this.y
    },
    answer () {
      let res = [this.good]

      while (res.length < 4) {
        let newNumver = randomNumber(this.good - 10, this.good + 10)
        if (res.indexOf(newNumver) === -1) {
          res.push(newNumver)
        }
      }

      return res.sort()
    }
  },
  methods: {
    onAnswer (num) {
      if (num === this.good) {
        this.$emit('success')
      } else {
        this.$emit('error', `${this.x} + ${this.y} = ${this.good}!`)
      }
    }
  }
}
function randomNumber (min, max) {
  let diff = max - min
  return Math.floor(Math.random() * (diff + 1) + min)
}
</script>

<style>

</style>
