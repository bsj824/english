<template>
  <div class="link">
    <Panel :title="title">
      <Form ref="form" :rules="rules" :model="formData" :label-width="80">
        <Form-item label="URL" prop="url" :error="errors.url">
          <Input v-model="formData.url" placeholder="请设置链接url"></Input>
        </Form-item>
        <Form-item label="链接名称" prop="name" :error="errors.name">
          <Input v-model="formData.name" placeholder="请输入链接名称"></Input>
        </Form-item>
        <Form-item label="联系人" :error="errors.linkman">
          <Input v-model="formData.linkman" placeholder="请输入联系人"></Input>
        </Form-item>
        <Form-item label="图片" :error="errors.logo">
          <UploadPicture @on-remove="() => formData.logo = null" @on-success="logo => formData.logo = logo" :url="formData.logo_url" height="180px" class="upload_picture" />
        </Form-item>
        <Form-item label="分类" prop="type_name" :error="errors.type_name">
          <Select v-model="formData.type_name" style="width:200px">
            <Option v-for="item in types" :value="item.name" :key="item.id">{{ item.display_name }}</Option>
          </Select>
        </Form-item>
        <Form-item label="是否显示" :error="errors.is_visible">
          <i-switch v-model="formData.is_visible" size="large">
            <span slot="open">显示</span>
            <span slot="close">隐藏</span>
          </i-switch>
        </Form-item>
        <FormButtomGroup />
      </Form>
    </Panel>
  </div>
</template>

<script>
import Panel from '../../components/Panel.vue';
import fromMixin from '../../mixins/form';
import FormButtomGroup from '../../components/FormButtonGroup.vue';
import UploadPicture from '../../components/UploadPicture.vue';
export default {
  computed: {
    rules () {
      return {
        url: [
          { required: true, message: '请填写URL', trigger: 'blur' },
          { type: 'url', message: 'URL格式不正确', trigger: 'blur' }
        ],
        name: [
          { required: true, type: 'string', message: '请填写链接名称', trigger: 'blur' }
        ],
        type_name: [
          { required: true, type: 'string', message: '请选择分类', trigger: 'change' }
        ]
      };
    },
    mixinConfig () {
      return {
        title: '链接',
        action: this.isAdd() ? 'links' : `links/${this.$route.params.id}`
      };
    }
  },
  components: { Panel, FormButtomGroup, UploadPicture },
  mixins: [ fromMixin ],
  data () {
    return {
      types: [],
      formData: {
        'url': null,
        'name': null,
        'logo': null,
        'linkman': null,
        'type_name': null,
        'is_visible': true,
      }
    };
  },
  mounted () {
    this.$on('on-success', () => {
      this.$router.push({name: 'linkList'});
    });
    this.$http.get('types', {
      params: {
        model: 'link'
      }
    }).then(res => {
      this.types = res.data.data;
    });
  }
};
</script>

<style scoped lang="less">
.link{
  .upload_picture{
    width: 180px;
    margin-top: 10px;
  }
}
</style>
