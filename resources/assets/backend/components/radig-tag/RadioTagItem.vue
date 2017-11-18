<template>
  <div @click="checkMe" class="radio_tag_item" :class="{'checked': $parent.value === value}">
    <span :style="{ background: color }" class="dot"></span>
    <span class="text"><slot></slot></span>
  </div>
</template>

<script>
export default {
  name: 'RadioTagItem',
  props: {
    color: String,
    value: [String, Number]
  },
  methods: {
    checkMe () {
      this.$parent.currentValue = this.value;
    }
  }
};
</script>

<style scoped lang="less">
  .radio_tag_item{
    margin-right: 15px;
    float: left;
    height: 32px;
    line-height: 32px;
    border: 1px #ddd solid;
    color: #495060;
    background: #fff;
    padding: 0 10px;
    border-radius: 3px;
    cursor: pointer;
    transition: all .3s;
    &:hover, &.checked{
      color: #007fff;
      border-color: rgba(0,127,255,.8);
      background-color: rgba(0,127,255,.05);
    }
    >.dot{
      display: inline-block;
      width: 12px;
      height: 12px;
      margin-right: 10px;
      border-radius: 50%;
      background: #e9eaec;
      position: relative;
      top: 1px;
    }
  }
</style>
