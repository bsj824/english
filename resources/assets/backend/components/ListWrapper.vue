<template>
  <div class="list_wrapper">
    <header>
      <h1 class="title">{{title}}
        <span class="total">{{total}}</span>
      </h1>
      <div class="option">
        <slot name="option"></slot>
      </div>
      <Input class="search" v-model="keyword" placeholder="输入关键字搜索">
        <Select v-model="searchScope" slot="prepend" style="width: 80px">
          <Option value="all">全部</Option>
          <Option :key="index" :value="item" v-for="(item, index) in allowSearchFields">{{getTitle(item)}}</Option>
        </Select>
      </Input>
      <div style="clear: both;"></div>
    </header>
    <div class="search_info" v-if="keyword.length > 0">
      搜索到 {{total}} 条数据<Button class="btn" size="small" type="warning" icon="close" @click="keyword = '', searchScope = 'all'">清除搜索</Button>
    </div>
    <main>
      <slot :data="list"></slot>
    </main>
    <footer>
      <Page v-if="total > pageSize" @on-page-size-change="(pageSize) => {perPage = pageSize}" :page-size="perPage" @on-change="change" :current.sync="currentPage" class="page" size="small" :total="total" show-sizer></Page>
    </footer>
  </div>
</template>

<script>
import listMixin from '../mixins/list';
export default {
  name: 'listWrapper',
  mixins: [ listMixin ]
};
</script>

<style lang="less" scoped>
.list_wrapper{
  >header{
    margin-bottom: 25px;
    >.title{
      font-weight: 400;
      line-height: 32px;
      font-size: 20px;
      float: left;
      >.total{
        font-size: 14px;
        color: #888;
        margin-left: 5px;
      }
    }
    >.search {
      float: right;
      width: 360px;
      margin-right: 10px;
      position: relative;
      z-index: 9;
    }
    >.option{
      float: right;
      margin-right: 10px;
    }
  }
  .search_info{
    padding: 0 10px;
    line-height: 50px;
    margin-bottom: 20px;
    font-size: 16px;
    border: 1px dashed hsla(0,0%,40%,.2);
    color: #777;
    .btn{
      float: right;
      margin-top: 12px;
    }
  }
  >footer{
    margin-top: 20px;
    >.page{
      float: right;
    }
  }
}
</style>


