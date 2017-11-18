<template>
  <div class="banner">
    <Panel :title="title">
      <Form ref="form" :rules="rules" :model="formData" :label-width="80">
        <Form-item label="标题" :error="errors.title" prop="title">
          <Input v-model="formData.title" placeholder="请设置标题"></Input>
        </Form-item>
        <Form-item label="URL" :error="errors.url" prop="url">
          <Input v-model="formData.url" placeholder="请设置Banner URL"></Input>
        </Form-item>
        <Form-item label="分类" :error="errors.type_name" prop="type_name">
          <Select v-model="formData.type_name" style="width:200px">
            <Option v-for="item in types" :value="item.name" :key="item.id">{{ item.display_name }}</Option>
          </Select>
        </Form-item>
        <Form-item label="图片" :error="errors.image" prop="image">
          <UploadPicture  @on-remove="() => formData.image = null" @on-success="image => formData.image = image" :url="formData.image_url" height="180px" class="upload_picture" />
        </Form-item>
        <Form-item :error="errors.is_visible" label="是否显示">
          <i-switch v-model="formData.is_visible" size="large">
            <span slot="open">显示</span>
            <span slot="close">隐藏</span>
          </i-switch>
        </Form-item>
      </Form>
      <FormButtomGroup />
    </Panel>
  </div>
</template>

<script>
import Panel from '../../components/Panel.vue';
import fromMixin from '../../mixins/form';
import FormButtomGroup from '../../components/FormButtonGroup.vue';
import UploadPicture from '../../components/UploadPicture.vue';
export default {
  components: { Panel, FormButtomGroup, UploadPicture },
  mixins: [ fromMixin ],
  computed: {
    rules () {
      return {
        type_name: [
          { required: true, type: 'string', message: '请选择分类', trigger: 'change' }
        ],
        url: [
          { type: 'url', message: 'URL格式不正确', trigger: 'blur' }
        ],
        image: [
          { required: true, message: '请上传图片', trigger: 'change' }
        ]
      };
    },
    mixinConfig () {
      return {
        title: 'Banner',
        action: this.isAdd() ? 'banners' : `banners/${this.$route.params.id}`
      };
    }
  },
  data () {
    return {
      types: [],
      formData: {
        'url': null,
        'title': null,
        'image': null,
        'type_name': null,
        'is_visible': true
      }
    };
  },
  mounted () {
    this.$on('on-success', () => {
      this.$router.push({name: 'bannerList'});
    });
    this.$http.get('types', {
      params: {
        model: 'banner'
      }
    }).then(res => {
      this.types = res.data.data;
    });
  }
};
</script>

<style scoped lang="less">
.banner{
  .upload_picture{
    margin-top: 10px;
  }
}
</style>
