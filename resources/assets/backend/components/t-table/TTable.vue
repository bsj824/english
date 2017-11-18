<template>
  <div class="table-wrapper">
    <table v-if="data.length > 0" border="0" cellspacing="0" cellpadding="0" class="ttable">
      <thead>
        <tr>
          <th v-for="col in columns" :key="col.key" :style="{width: col.width ? col.width : 'auto', 'text-align': col.align}">{{col.title}}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item,index) in data" :key="index">
          <td v-for="col in columns" :key="col.key">
            <div class="td-item" :class="col.type" :style="col.style">
              <template v-if="!col.render">
                {{item[col.key]}}
              </template>
              <TableRenderItem v-else :render="col.render" :params="item"></TableRenderItem>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <NoData v-if="data.length === 0"/>
  </div>
</template>

<script>
  import NoData from '../NoData.vue';
  import TableRenderItem from './TableRenderItem.vue';
  export default {
    name: 'TTable',
    components: { TableRenderItem, NoData },
    props: {
      data: Array,
      columns: Array
    },
    mounted () {
    }
  };
</script>

<style scoped lang="less">
.table-wrapper{
  width: 100%;
  height: 100%;
  background: #fff;
  border-radius: 4px;
  box-shadow: 1px 1px 2px #dfe5ed;
  overflow: hidden;
  .ttable{
    width: 100%;
    td, th {
      text-align: center;
      height: 40px;
      padding: 0 10px;
      border-bottom: 1px solid #efefef;
    }
    >thead {
      font-size: 14px;
      color: #222;
      >tr{
        &:hover{
          background-color: #fff;
        }
        >th{
          text-align: center;
        }
      }
    }
    >tbody {
      font-size: 14px;
      color: #666;
      >tr {
        height: auto;
        min-height: 40px;
        .td-item{
          padding: 10px 0;
          overflow: hidden;
          &.gray{
            color: #999;
          }
        }
      }
    }
    tr {
      height: 65px;
      &:hover{
        background-color: #f8f9fb;
        transition: background-color .2s;
      }
    }
  }
  .no_data{
    margin: 120px auto 80px;
  }
}
</style>
