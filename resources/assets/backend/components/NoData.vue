<template>
  <div class="no_data">
    <p>{{tip}}</p>
    <div class="img"></div>
  </div>
</template>
<script>
export default {
  name: 'NoData',
  props: {
    tip: {
      type: String,
      default: '没有数据("▔□▔)/'
    }
  }
};
</script>
<style lang="less" scoped>
.no_data{
    height: 270px;
    width: 235px;
    margin: 0 auto;
    >p{
        margin-top: 60px;
        text-align: center;
        font-size: 16px;
        margin-bottom: 20px;
    }
    >.img{
      width: 234px;
      height: 177px;
      background: url(../static/images/err-no-list.png) no-repeat bottom;
      margin: 0 auto;
    }
}
</style>
