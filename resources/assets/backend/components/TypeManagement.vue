<template>
  <div class="type_management">
    <Modal width="700" v-model="showTypeListDialog" title="分类列表">
      <Button style="margin-bottom: 15px;" class="add_btn" @click="showAddDialog" icon="plus-round" type="primary">添加</Button>
      <Table :columns="tyleCol" :data="types"></Table>
    </Modal>
    <!-- 编辑分类 -->
    <Modal width="450" v-model="showTypeEditDialog" :title="title" @on-ok="confirm" :loading="showTypeEditLoading">
      <Form :model="formData" :label-width="60">
        <Form-item label="分类" :error="errors.name">
          <Input v-model="formData.name" placeholder="请设置分类，字母数字组成"></Input>        
        </Form-item>
        <Form-item label="分类名称" :error="errors.display_name">
          <Input v-model="formData.display_name" placeholder="请设置分类名称"></Input>
        </Form-item>
        <Form-item label="描述" :error="errors.description">
          <Input v-model="formData.description" type="textarea" :rows="4" placeholder="请设置描述"></Input>
        </Form-item>
      </Form>
    </Modal>
  </div>
</template>

<script>
import fromMixin from '../mixins/form';
import delMixin from '../mixins/del';
export default {
  name: 'typeManagement',
  props: {
    typeQueryName: String,
    value: {
      type: Boolean,
      default: false
    }
  },
  watch: {
    'value' (curVal) {
      if (this.showTypeListDialog !== curVal) {
        this.showTypeListDialog = curVal;
      }
    },
    'showTypeListDialog' (curVal) {
      this.$emit('input', curVal);
    }
  },
  mixins: [ fromMixin, delMixin ],
  computed: {
    mixinConfig () {
      return {
        title: '分类',
        action: this.id ? `types/${this.id}` : 'types'
      };
    }
  },
  data () {
    return {
      id: null,
      formData: {
        'name': null,
        'display_name': null,
        'description': null,
        'model_name': this.typeQueryName
      },
      types: [],
      showTypeListDialog: this.value,
      showTypeEditDialog: false,
      showTypeEditLoading: true,
      tyleCol: [
        {
          title: '分类',
          key: 'name'
        },
        {
          title: '分类名称',
          key: 'display_name'
        },
        {
          title: '描述',
          key: 'description'
        },
        {
          title: '操作',
          key: 'action',
          render: (h, params) => {
            return h('div', [
              h('Button', {
                props: {
                  type: 'primary',
                  size: 'small'
                },
                style: {
                  marginRight: '5px'
                },
                on: {
                  click: () => {
                    this.id = params.row.id;
                    this.init();
                    this.showTypeEditDialog = true;
                  }
                }
              }, '编辑'),
              h('Button', {
                props: {
                  type: 'error',
                  size: 'small'
                },
                on: {
                  click: () => { this.del(params.row.id); }
                }
              }, '删除')
            ]);
          }
        }
      ]
    };
  },
  methods: {
    isAdd () {
      return this.id === null;
    },
    getTypeList () {
      this.$http.get('types', {
        params: {
          model: this.typeQueryName
        }
      }).then(res => {
        this.types = res.data.data;
      });
    },
    showAddDialog () {
      this.id = null;
      this.formData = this.rowFormData;
      this.init();
      this.showTypeEditDialog = true;
    }
  },
  mounted () {
    this.getTypeList();
    this.rowFormData = this.formData;
    this.$on(['on-success', 'del-success'], () => {
      this.getTypeList();
      this.$emit('change');
      this.showTypeEditDialog = false;
    });
    this.$on('on-loaded', () => {
      this.showTypeEditLoading = false;
      this.$nextTick(() => {
        this.showTypeEditLoading = true;
      });
    });
  }
};
</script>

<style scoped lang="less">

</style>
