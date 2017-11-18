<template>
  <Button-group class="submit_btn_group">
    <Button :loading="loading" @click="submit" type="success">确认提交</Button>
    <Button @click="$router.back()">取消</Button>
  </Button-group>
</template>
<script>
export default {
  name: 'FormButtonGroup',
  data () {
    return {
      loading: false
    };
  },
  methods: {
    submit () {
      this.loading = true;
      let parent = this.$parent;
      while (parent !== undefined && typeof parent.confirm !== 'function') {
        parent = parent.$parent;
      }
      parent.$on('on-loaded', () => {
        this.loading = false;
      });
      parent.confirm();
    }
  },
  mounted () {
  }
};
</script>

<style lang="less" scoped>
.submit_btn_group{
  margin-top: 20px;
  margin-left: 80px;
}
</style>
