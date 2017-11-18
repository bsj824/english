<template>
  <textarea ref="textarea" :style="textareaCalcStyle" v-model="currentValue" rows="1" class="input" placeholder="请输入标题"></textarea>
</template>
<script>
import calcTextareaHeight from '../utils/calcTextareaHeight.js';
export default {
  name: 'titleInput',
  props: {
    value: [String, Number]
  },
  data () {
    return {
      currentValue: this.value,
      textareaCalcStyle: {}
    };
  },
  watch: {
    'value' (curVal) {
      this.currentValue = curVal;
    },
    'currentValue' (curVal) {
      this.textareaCalcStyle = calcTextareaHeight(this.$refs.textarea);
      this.$emit('input', curVal);
    }
  }
};
</script>

<style scoped lang="less">
.input{
    height: 44px;
    min-height: 44px;
    display: block;
    width: 100%;
    border: 0;
    font-size: 32px;
    line-height: 1.4;
    font-weight: 700;
    outline: none;
    box-shadow: none;
    padding: 0;
    overflow: hidden;
    background: transparent;
    border: none;
    outline: none;
    resize: none;
}
</style>
