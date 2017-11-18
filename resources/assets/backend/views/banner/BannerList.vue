<template>
  <div class="banner_list">
    <RadioGroup v-model="typeName" class="types" type="button" size="large">
      <Radio v-for="item in types" :key="item.id" :label="item.name">{{item.display_name}}</Radio>
    </RadioGroup>
    <Button icon="wrench" :class="{'type_manage_btn': types.length > 0}" @click="showTypeManagementDialog = true"  type="primary">管理分类</Button>
    <Button class="add_btn" @click="$router.push({name: 'addBanner'})" icon="plus-round" type="primary">添加banner</Button>
    <draggable v-model="list" :options="{draggable: '.row', animation: 300}" @end="reSort">
      <DraggableRow
        v-for="item in list"
        :key="item.id"
        :id="item.id"
        :url="item.url"
        :time="item.created_at"
        :pic="item.image_url"
        :title="item.title"
        @on-edit="id => $router.push({name: 'editBanner', params: { id }})"
        @on-del="del"
        ></DraggableRow>
    </draggable>
    <main class="sample">
      <SplitLine class="split_line">示例</SplitLine>
      <Carousel3d height="200" v-if="list.length > 0" :controls-visible="true" :count="list.length">
        <Slide v-for="(item, index) in list" :key="index" :index="index">
          <img :src="item.image_url">
        </Slide>
      </Carousel3d>
      <NoData v-else></NoData>
    </main>
    <TypeManagement @change="refreshType" typeQueryName="banner" v-model="showTypeManagementDialog"/>
  </div>
</template>

<script>

import { Carousel3d, Slide } from 'vue-carousel-3d';
import SplitLine from '../../components/SplitLine.vue';
import listWithTypeMixin from '../../mixins/listWithType';
export default {
  computed: {
    mixinConfig () {
      return {
        title: 'banners',
        action: 'banners'
      };
    }
  },
  components: { Carousel3d, Slide, SplitLine },
  mixins: [ listWithTypeMixin ],
};
</script>

<style lang="less" scoped>
.banner_list{
  .sample{
    margin: 30px 0;
    padding: 50px 40px 30px 40px;
    background-color: #fff;
    border-radius: 5px;
    .split_line{
      margin-bottom: 50px;
    }
    img{
      height: 100%;
    }
  }
}
</style>
