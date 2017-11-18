<template>
  <div>
    <slot></slot>
  </div>
</template>

<script>
export default {
  name: 'radioTagGroup',
  props: {
    value: [String, Number]
  },
  data () {
    return {
      currentValue: this.value
    };
  },
  watch: {
    'value' (curVal) {
      if (this.currentValue !== curVal) {
        this.currentValue = curVal;
      }
    },
    'currentValue' (curVal) {
      this.$emit('input', curVal);
    }
  }
};
</script>

<style scoped lang="less">

</style>
