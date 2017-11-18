<template>
  <div class="user">
    <Panel :title="title">
      <Form ref="form" :rules="rules" :model="formData" :label-width="80">
        <Form-item label="用户名" prop="user_name" :error="errors.user_name">
          <Input v-model="formData.user_name" placeholder="请设置用户名"></Input>
        </Form-item>
        <Form-item label="昵称" prop="nick_name" :error="errors.nick_name">
          <Input v-model="formData.nick_name" placeholder="请设置用户昵称"></Input>
        </Form-item>
        <Form-item label="email" prop="email" :error="errors.email">
          <Input v-model="formData.email" placeholder="请设置email"></Input>
        </Form-item>
        <Form-item label="密码" prop="password" :error="errors.password">
          <Input v-model="formData.password" type="password" placeholder="请设置密码 留空则保持原密码"></Input>
        </Form-item>
        <Form-item label="头像" :error="errors.avatar">
          <UploadPicture  @on-remove="() => formData.avatar = null" @on-success="avatar => formData.avatar = avatar" :url="formData.avatar_url" height="180px" class="upload_picture" />
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
        user_name: [
          { required: true, type: 'string', message: '请填写用户名', trigger: 'blur' }
        ],
        nick_name: [
          { required: true, type: 'string', message: '请填写用户昵称', trigger: 'blur' }
        ],
        email: [
          { required: true, message: '邮箱不能为空', trigger: 'blur' },
          { type: 'email', message: '邮箱格式不正确', trigger: 'blur' }
        ],
        password: [
          { required: this.isAdd(), type: 'string', message: '请设置密码', trigger: 'blur' }
        ],
      };
    },
    mixinConfig () {
      return {
        title: '用户',
        action: this.isAdd() ? 'users' : `users/${this.$route.params.id}`,
      };
    }
  },
  mounted () {
    this.$on('on-success', () => {
      this.$router.push({name: 'userList'});
    });
  },
  data () {
    return {
      formData: {
        'user_name': null,
        'nick_name': null,
        'password': null,
        'email': null,
        'avatar': null,
        'roles': null,
        'permissions': null
      }
    };
  }
};
</script>
<style lang="less" scoped>
.user{
  .upload_picture{
    width: 180px;
    margin-top: 10px;
  }
}
</style>
