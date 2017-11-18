<template>
  <div class="column_list">
    <header>
      <h1 class="title">栏目列表</h1>
      <div class="option">
        <span><Button @click="$router.push({name: 'addColumn'})" icon="plus-round" type="primary">添加</Button></span>
      </div>
    </header>
    <TTable :columns="columCol" :data="categories" />
  </div>
</template>

<script>
import TTable from '../../components/t-table';
import HoverableTime from '../../components/HoverableTime.vue';
import delMixin from '../../mixins/del';
import NestedSort from '../../components/NestedSort.vue';
export default {
  mounted () {
    this.getCategories();
    this.$on('del-success', id => {
      this.getCategories();
    });
  },
  methods: {
    getCategories () {
      this.$http.get('categories/visual_output').then(res => {
        this.categories = res.data.data;
      });
    }
  },
  computed: {
    mixinConfig () {
      return {
        title: '栏目',
        action: 'categories'
      };
    }
  },
  mixins: [ delMixin ],
  data () {
    return {
      categories: [],
      catesWithChild: [],
      columCol: [
        {
          title: '栏目图片',
          key: 'image',
          width: '140px',
          render: (h, params) => {
            return h('Avatar', {
              props: {
                shape: 'square',
                src: params.image_url
              }
            }, params.image_url == null ? params.cate_name.substr(0, 1) : undefined);
          },
        },
        {
          title: '栏目名',
          key: 'cate_name',
          align: 'left',
          style: {'text-align': 'left'},
          render: (h, params) => {
            return h('span', params.indent_str + params.cate_name);
          },
        },
        {
          title: 'slug',
          key: 'slug',
          width: '150px',
          render: (h, params) => {
            return h('span', {
              attrs: {
                title: params.slug
              }
            }, params.slug && params.slug.length > 16 ? params.slug.substr(0, 16) + '...' : params.slug);
          }
        },
        {
          title: '类型',
          key: 'type',
          width: '110px',
          render: (h, params) => {
            let color, text;
            switch (params.type) {
              case 'post':
                color = 'blue';
                text = '列表模版';
                break;
              case 'link':
                color = 'green';
                text = '外部链接';
                break;
              case 'page':
                color = 'yellow';
                text = '单页模版';
                break;
            }
            return h('Tag', {
              props: {
                type: 'border',
                color
              }
            }, text);
          },
        },
        {
          title: '创建日期',
          key: 'created_at',
          render: (h, params) => {
            return h(HoverableTime, {
              props: {time: params.created_at}
            });
          },
          width: '110px'
        },
        {
          title: '是否为导航',
          key: 'is_nav',
          width: '110px',
          render: (h, params) => {
            return h('Tag', {
              props: {
                type: 'border',
                color: params.is_nav ? 'green' : undefined
              }
            }, params.is_nav ? '导航' : '普通');
          },
        },
        {
          title: '操作',
          key: 'action',
          render: (h, params) => {
            let type, text;
            switch (params.type) {
              case 'post':
                type = 'success';
                text = '显示文章';
                break;
              case 'link':
                type = 'warning';
                text = '访问外链';
                break;
              case 'page':
                type = 'info';
                text = '编辑单页';
                break;
            }
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
                    this.$router.push({name: 'editColumn', params: {id: params.id}});
                  }
                }
              }, '编辑'),
              h('Button', {
                props: {
                  type,
                  size: 'small'
                },
                style: {
                  marginRight: '5px'
                },
                on: {
                  click: () => {
                    if (params.type === 'post') {
                      this.$router.push({name: 'articleList', params: {id: params.id}});
                    } else if (params.type === 'link') {
                      window.open(params.url);
                    } else {
                      this.$router.push({name: 'page', params: {id: params.id}});
                    }
                  }
                }
              }, text),
              h('Button', {
                props: {
                  type: 'error',
                  size: 'small'
                },
                on: {
                  click: () => { this.del(params.id); }
                },
              }, '删除')
            ]);
          }
        }
      ]
    };
  },
  components: { TTable, HoverableTime, NestedSort }
};
</script>

<style scoped lang="less">
.column_list{
  >header{
    margin-bottom: 25px;
    overflow: hidden;
    >.title{
      font-weight: 400;
      line-height: 32px;
      font-size: 20px;
      float: left;
      >.total{
        font-size: 14px;
        color: #888;
        margin-left: 5px;
      }
    }
    >.option{
      float: right;
      margin-right: 10px;
    }
  }
}
</style>
