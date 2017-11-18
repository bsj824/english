<template>
    <router-view class="height-100p"></router-view>
</template>
<script>
export default {
};
</script>
// todo image onerror
<style lang="less">
  body, html {
    font-family: Helvetica Neue,Helvetica,PingFang SC,Hiragino Sans GB,Microsoft YaHei,Arial,sans-serif;
    background-color: #f1f3f7;
    text-rendering: optimizelegibility;
  }
  .height-100p, body, html {
    height: 100%;
  }
.link_list, .banner_list{
  .types{
    margin-bottom: 20px;
  }
  .type_manage_btn{
    position: relative;
    top: -10px;
    left: 5px;
  }
  .add_btn{
    float: right;
  }
}
.ivu-alert.ivu-alert-error{
  margin-top: 10px;
}
</style>
