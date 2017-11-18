<template>
  <div class="split-line">
    <div :style="{'background-color': bgColor}" class="split-text">
      <slot></slot>
    </div>
  </div>
</template>
<script>
export default {
  name: 'splitLine',
  props: {
    bgColor: {
      type: String,
      default: '#fff'
    }
  }
};
</script>

<style scoped lang="less">
.split-line {
    position: relative;
    width: 100%;
    height: 1px;
    background: #e5e9ef;
    .split-text {
      position: absolute;
      width: 120px;
      left: 50%;
      top: -15px;
      margin-left: -60px;
      height: 30px;
      line-height: 30px;
      text-align: center;
      color: #99a2aa;
      font-size: 18px;
    }
}
</style>
