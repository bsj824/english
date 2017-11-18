<template>
  <div class="hoverable_time">
    <Poptip placement="top" trigger="hover" width="160">
      <time>{{shortTime}}</time>
      <div class="detail" slot="content">
        {{time}}
      </div>
    </Poptip>
  </div>
</template>

<script>
export default {
  name: 'hoverableTime',
  props: {
    time: String
  },
  computed: {
    shortTime () {
      return this.time.substring(0, 11);
    }
  }
};
</script>

<style lang="less">
.hoverable_time{
 .detail{
    padding: 10px 16px;
    border-radius: 4px;
    white-space: nowrap;
    line-height: 1.5;
    font-size: 13px;
    color: #fff;
    background-color: rgba(0, 0, 0, .8);
  }
  time{
    color: #777;
  }
  .ivu-poptip-body{
    padding: 0;
  }
  .ivu-poptip-popper[x-placement^=top] .ivu-poptip-arrow:after, .ivu-poptip-popper[x-placement^=top] .ivu-poptip-arrow{
    border-top-color: rgba(0, 0, 0, .8);
  }
}
</style>




