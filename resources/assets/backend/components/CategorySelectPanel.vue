<template>
  <div class="category_select_panel">
    <Panel title="选择分类" full size="small">
      <div class="cate_body">
        <Select v-model="currentPCateId" class="p_type">
          <Option v-for="cate in categories" :value="cate.id" :key="cate.id">{{cate.cate_name}}</Option>
        </Select>
        <RadioTagGroup v-if="currentPCateId != null" v-model="currentCateId">
          <RadioTagItem :key="currentPcate.id" :value="currentPcate.id" color="#2d8cf0">{{currentPcate.cate_name}}</RadioTagItem>
          <RadioTagItem v-for="childCate in childCategories" :key="childCate.id" :value="childCate.id" color="#f90">{{childCate.cate_name}}</RadioTagItem>
        </RadioTagGroup>
      </div>
      <Alert v-if="cateError" type="error">{{cateError}}</Alert>
    </Panel>
  </div>
</template>

<script>
import Panel from './Panel.vue';
import { RadioTagGroup, RadioTagItem } from './radig-tag';
export default {
  name: 'categorySelectPanel',
  components: { Panel, RadioTagGroup, RadioTagItem },
  props: {
    cid: Number,
    cateError: String
  },
  data () {
    return {
      categories: [],
      childCategories: [],
      currentPcate: {},
      currentPCateId: null,
      currentCateId: null
    };
  },
  methods: {
    updateView (newCid) {
      if (newCid !== null && this.categories.length > 0) {
        for (let cate of this.categories) {
          if (cate.id === newCid) {
            this.currentPcate = cate;
            this.childCategories = cate.children.data;
            this.currentPCateId = cate.id;
            this.currentCateId = newCid;
            return;
          }
          for (let childCate of cate.children.data) {
            if (childCate.id === newCid) {
              this.currentPCateId = cate.id;
              this.currentCateId = childCate.id;
              return;
            }
          }
        }
      }
    }
  },
  watch: {
    'cid' (newId) {
      this.updateView(newId);
    },
    'currentPCateId' (newId) {
      for (let cate of this.categories) {
        if (cate.id === newId) {
          this.currentPcate = cate;
          this.childCategories = cate.children.data;
          break;
        }
      }
    },
    'currentCateId' (newId) {
      if (this.cid !== newId) {
        this.$emit('update:cid', newId);
      }
    }
  },
  mounted () {
    this.$http.get('categories', {
      params: {
        type: 'post'
      }
    }).then(res => {
      this.categories = res.data.data;
      this.currentPCateId = this.categories[0].id;
      this.updateView(this.cid);
    });
  }
};
</script>

<style scoped lang="less">
.category_select_panel{
  .cate_body{
    overflow: hidden;
  }
  .p_type{
    float: left;
    width: 100px;
    margin-right: 30px;
  }
}
</style>
