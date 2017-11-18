<template>
  <div class="m-info">
    <a href="#" target="_blank">
      <i class="user-pic" :style="{'background-image': `url(${avatar_url}?p=avatar_xs)`}"></i>
      <span class="user-name">{{nick_name}}</span>
    </a>
  </div>
</template>

<script>
export default{
  name: 'UserWeight',
  props: {
    avatar_url: String,
    nick_name: String,
    id: Number
  }
};
</script>

<style scoped lang="less">
  .m-info {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 130px;
    display: inline-block;
    >a{
      display: block;
      text-align: left;
    }
    .user-pic {
      display: inline-block;
      width: 30px;
      height: 30px;
      border-radius: 100%;
      vertical-align: middle;
      background-size: 100% 100%;
      margin-right: 8px;
    }
    .user-name {
      display: inline-block;
      line-height: 30px;
      height: 30px;
      color: #222;
    }
  }
</style>
