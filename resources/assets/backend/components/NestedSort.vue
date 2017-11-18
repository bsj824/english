<template>
  <draggable :list="data" :options="options">
    <template v-for="(node, index) in data">
      <ul v-if="node.children && node.children.data.length != 0" class="nested_sort_node">
        <li class="item parent">
          <Icon class="icon" type="navicon"></Icon>{{ node.cate_name }}
        </li>
        <nested-sort :data="node.children.data" :options="options"></nested-sort>
      </ul>
      <li v-else class="item">
        <Icon class="icon" type="navicon"></Icon>{{ node.cate_name }}
      </li>
    </template>
  </draggable>
</template>

<script>
  import draggable from 'vuedraggable';
  export default {
    components: { draggable },
    name: 'nestedSort',
    props: {
      data: Array,
      options: Object,
    }
  };
</script>

<style lang="less">
.nested_sort_node_wrapper>div>:last-child.item, .nested_sort_node_wrapper>div>:last-child.nested_sort_node>div>.item:last-child{
  border-bottom: 1px solid #ccd0d7;
}

.nested_sort_node{
  width: 300px;
  border-radius: 4px;
  .item + div > .item {
    margin-left: 30px;
    &:first-child{
      border-top: none;
    }
  }
  .item{
    border: 1px solid #ccd0d7;
    border-bottom: none;
    height: 42px;
    line-height: 42px;
    padding: 0 10px;
    cursor: move;
    transition: background-color .2s ease;
    font-size: 14px;
    &.parent{
      border-bottom: 1px solid #ccd0d7;
      &:hover{
        +div>.item{
          background-color: #00a1d6;
          color: #fff;
          .icon{
            color: #fff;
          }
        }
      }
    }
    &:hover{
      background-color: #00a1d6;
      color: #fff;
      .icon{
        color: #fff;
      }
    }
    .icon{
      font-size: 16px;
      margin-right: 10px;
      color: #999;
    }
  }
}
</style>
