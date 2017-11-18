<template>
  <div class="link_list">
    <RadioGroup v-model="typeName" class="types" type="button" size="large">
      <Radio v-for="item in types" :key="item.id" :label="item.name">{{item.display_name}}</Radio>
    </RadioGroup>
    <Button icon="wrench" :class="{'type_manage_btn': types.length > 0}" @click="showTypeManagementDialog = true"  type="primary">管理分类</Button>
    <Button class="add_btn" @click="$router.push({name: 'addLink'})" icon="plus-round" type="primary">添加链接</Button>
    <draggable v-model="list" :options="{draggable: '.row', animation: 300}"  @end="reSort">
      <DraggableRow 
        v-for="item in list"
        :key="item.id"
        :id="item.id"
        :url="item.url"
        :time="item.created_at"
        :pic="item.logo_url"
        :title="item.name"
        @on-edit="id => $router.push({name: 'editLink', params: { id }})"
        @on-del="del"
        ></DraggableRow>
    </draggable>
    <NoData v-if="list.length ===  0"></NoData>
    <TypeManagement @change="refreshType" typeQueryName="link" v-model="showTypeManagementDialog"/>
  </div>
</template>

<script>
import listWithTypeMixin from '../../mixins/listWithType';
export default {
  computed: {
    mixinConfig () {
      return {
        title: '链接',
        action: 'links'
      };
    }
  },
  mixins: [ listWithTypeMixin ]
};
</script>

<style scoped lang="less">

</style>
