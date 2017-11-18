<template>
  <div class="tag_auto_complete_wrap">
    <multiselect
      v-model="selected"
      :multiple="true"
      placeholder="添加标签"
      :taggable="true"
      @tag="addTag"
      label="name"
      @search-change="searchChange"
      track-by="id"
      :options="tags">
      <span slot="noResult">
        没有结果
      </span>
    </multiselect>
  </div>
</template>

<script>
  import Multiselect from 'vue-multiselect';
  import 'vue-multiselect/dist/vue-multiselect.min.css';
  export default {
    components: { Multiselect },
    props: {
      oldTags: {
        type: Array,
        default: () => {
          return [];
        }
      }
    },
    data () {
      return {
        selected: this.oldTags,
        tags: []
      };
    },
    watch: {
      selected (newVal) {
        this.$emit('tag_ids', newVal.map(item => item.id));
      },
      oldTags (newVal) {
        this.selected = newVal;
      }
    },
    methods: {
      searchChange (query) {
        this.$http.get('/tags', {
          params: {
            keywords: query,
            search_scope: 'name'
          }
        }).then(res => {
          this.tags = res.data.data;
        });
      },
      addTag (newTag) {
        let newTagInTags = this.tags.find(item => item.name === newTag);
        if (newTagInTags) {
          this.selected.push(newTagInTags);
        } else {
          this.$http.post('tags', {
            name: newTag
          }).then(res => {
            this.selected.push(res.data.data);
          });
        }
      }
    },
    mounted () {
    }
  };
</script>

<style scoped lang="less">
  .tag_auto_complete{
    display: inline-block;
    height: 26px;
    width: 100px;
    color: #495060;
    border: 1.5px dashed #999;
    padding: 3px;
    padding-left: 20px;
    position: relative;
    border-radius: 3px;
    &:hover{
      border-color: #1d90e6;
      .icon {
        color: #1d90e6!important;
      }
    }
    .icon {
      position: absolute;
      top: 5px;
      left: 5px;
    }
    >input{
      outline: none;
      display: block;
      border: none;
      width: 100%;
      height: 100%;
    }
  }
</style>

