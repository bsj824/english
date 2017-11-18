import mixinConfig from './mixinConfig';
export default{
  mixins: [ mixinConfig ],
  data () {
    return {
      defaultConfig: {
        title: null,
        action: null
      }
    };
  },
  methods: {
    del (id) {
      this.$Modal.confirm({
        title: '确认删除？',
        content: `你确定要删除该${this.getConfig('title')}`,
        onOk: () => {
          this.$http.delete(this.getConfig('action') + `/${id}`).then(res => {
            this.$Message.success('已删除');
            let list = this.$refs['list'];
            if (list) {
              this.$refs['list'].refresh();
            }
            this.$emit('del-success', id);
          });
        }
      });
    }
  }
};
