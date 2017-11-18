<template>
  <svg class="logo" :class="{'small': size === 'small'}">
    <text v-for="i in 4" :key="i" text-anchor="middle" x="50%" y="50%" :class="'text text-' + i">
        {{logoText}}
    </text>
  </svg>
</template>
<script>
export default {
  name: 'logo',
  props: {
    size: String
  },
  data () {
    return {
      logoText: window.logo ? window.logo : 'tiny'
    };
  }
};
</script>

<style scoped>

.small .text{
  font-size: 32px;
}
.text{
    font-size: 64px;
    font-weight: bold;
    text-transform: uppercase;
    fill: none;
    stroke-width: 2px;
    stroke-dasharray: 90 310;
    animation: stroke 6s infinite linear;
}
.text-1{
    stroke: #3498db;
    text-shadow: 0 0 5px #3498db;
    animation-delay: -1.5s;
}
.text-2{
    stroke: #f39c12;
    text-shadow: 0 0 5px #f39c12;
    animation-delay: -3s;
}
.text-3{
    stroke: #e74c3c;
    text-shadow: 0 0 5px #e74c3c;
    animation-delay: -4.5s;
}
.text-4{
    stroke: #9b59b6;
    text-shadow: 0 0 5px #9b59b6;
    animation-delay: -6s;
}

@keyframes stroke {
  100% {
    stroke-dashoffset: -400;
  }
}
</style>
