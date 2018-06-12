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
    <span class="question-time" :class="timeClass(time)">{{ time }}</span>
    </div>
</template>

<script>
export default {
  data () {
    return {
      x: randomNumber(100, 500),
      y: randomNumber(100, 500),
      time: 0
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
    onAnswer (answer) {
      if (answer === this.good) {
        this.returnStatus('success', answer)
      } else {
        this.returnStatus('error', answer)
      }
    },
    logTimer () {
      this.time++
      if (this.time === 31) {
        this.returnStatus('error')
      }
    },
    timeClass (time) {
      if (time > 0 && time <= 10) {
        return 'color-green'
      } else if (time > 10 && time <= 20) {
        return 'color-yellow'
      } else if (time > 20) {
        return 'color-red'
      }
    },
    returnStatus (status = '', answer = '') {
      this.$emit(
        status,
        `${this.x} + ${this.y} = ${this.good}`,
        answer,
        this.time
      )
    }
  },
  timers: {
    logTimer: { time: 1000, autostart: true, repeat: true }
  }
}
function randomNumber (min, max) {
  let diff = max - min
  return Math.floor(Math.random() * (diff + 1) + min)
}
</script>

<style scoped>
  .body {
    position: relative;
  }
  .question-time {
    position: absolute;
    right: 30px;
    top: 20px;
    background: #999;
    padding: 5px;
    font-size: 20px;
  }
  .color-green {
    color: #7bff90;
  }
  .color-yellow {
    color: #fff979;
    font-size: 25px;
  }
  .color-red {
    color: #ff0013;
    font-size: 30px;
  }
</style>
