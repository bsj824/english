<template>
  <div class="row">
    <Icon class="icon" type="navicon"></Icon>
    <Avatar class="pic" size="large" shape="square" :src="pic">
      <template v-if="!pic">
        {{title.substr(0, 1)}}
      </template>
    </Avatar>
    <span class="title">{{title}}</span>
    <div class="info">
      <span>{{url}}</span>
      <span>
        <HoverableTime :time="time"></HoverableTime>
      </span>
    </div>
    <div class="option">
      <Button type="primary" @click="$emit('on-edit', id)" size="small">编辑</Button>
      <Button type="error" size="small" @click="$emit('on-del', id)">删除</Button>
    </div>
  </div>
</template>

<script>
import HoverableTime from './HoverableTime.vue';
export default {
  name: 'draggableRow',
  components: { HoverableTime },
  props: {
    id: Number,
    title: String,
    pic: String,
    url: String,
    time: String
  }
};
</script>

<style scoped lang="less">
  .row:first-child{
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }
  .row:last-child{
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
  }
  .row{
    background-color: #fff;
    border-bottom: 1px solid #efefef;
    height: 80px;
    padding: 0 10px;
    cursor: move;
    position: relative;
    transition: all .2s;
    &:hover{
      background-color: #f8f9fb;
    }
    .icon{
      position: absolute;
      left: 15px;
      font-size: 33px;
      color: #ddd;
      top: 23px;
    }
    .pic{
      position: absolute;
      left: 70px;
      top: 19px;
    }
    .title{
      margin-top: 19px;
      padding-left: 120px;
      width: 300px;
      font-size: 16px;
      color: #333;
      float: left;
    }

    .info{
      float: left;
      color: #999;
      font-size: 14px;
      margin-top: 20px;
      >span{
        line-height: 20px;
      }
    }
    .option{
      position: absolute;
      right: 20px;
      top: 27px;
    }
  }
</style>
