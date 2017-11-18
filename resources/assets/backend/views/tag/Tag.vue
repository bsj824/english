<template>
  <div class="role">
    <Panel :title="title">
      <Form ref="form" :rules="rules" :model="formData" :label-width="80">
        <Form-item :error="errors.name" label="标签" prop="name">
          <Input v-model="formData.name" placeholder="请设置标签"></Input>
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
export default {
  components: { Panel, FormButtomGroup },
  mixins: [ fromMixin ],
  computed: {
    rules () {
      return {
        name: [
          { required: true, type: 'string', message: '请填写标签', trigger: 'blur' }
        ]
      };
    },
    mixinConfig () {
      return {
        title: '标签',
        action: this.isAdd() ? 'tags' : `tags/${this.$route.params.id}`,
      };
    }
  },
  data () {
    return {
      formData: {
        'name': null
      }
    };
  },
  mounted () {
    this.$on('on-success', () => {
      this.$router.push({name: 'tagList'});
    });
  }
};
</script>

<style scoped lang="less">
</style>
