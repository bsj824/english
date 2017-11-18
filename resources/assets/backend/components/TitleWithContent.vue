<template>
 <main class="article_wrapper">
    <div class="title_input_wrapper">
      <TitleInput :value="title" @input="val => void $emit('update:title', val)"/>
      <Alert v-if="titleError" type="error">{{titleError}}</Alert>
    </div>
    <div id="ueditor_container"></div>
    <Alert v-if="contentError" type="error">{{contentError}}</Alert>
    <Upload
        class="upload"
        multiple
        name="attachment"
        :default-file-list="defaultFileList"
        :on-remove="handleRemove"
        :on-error="handleError"
        :on-success="handleSuccess"
        :headers="{'X-Requested-With': 'XMLHttpRequest'}"
        :action="action">
        <Button type="primary" icon="android-upload">上传附件</Button>
    </Upload>
  </main>
</template>

<script>
import TitleInput from './TitleInput.vue';
import tHttp from '../utils/tHttp';
export default {
  name: 'titleWithContent',
  props: {
    title: String,
    content: {
      type: String,
      default: ''
    },
    attachment_ids: Array,
    attachments: Array,
    titleError: String,
    contentError: String,
  },
  components: { TitleInput },
  watch: {
    'attachments' (newVal) {
      this.defaultFileList = newVal.map(item => {
        return {name: item.title};
      });
    }
  },
  data () {
    return {
      action: tHttp.config.baseURL + 'attachments',
      defaultFileList: [],
      editor: null
    };
  },
  methods: {
    initEditor () {
      const tokenMeta = document.head.querySelector('meta[name="csrf-token"]');
      let token = tokenMeta ? tokenMeta.content : '';

      this.editor = window.UE.getEditor('ueditor_container', {
        initialFrameHeight: 300
      });
      this.editor.ready(() => {
        this.editor.execCommand('serverparam', '_token', token);
        this.editor.addListener('selectionchange', () => {
          this.$emit('update:content', this.editor.getContent());
        });
        if (this.content) {
          this.editor.setContent(this.content);
        } else {
          let unwatch = this.$watch('content', (newVal, oldVal) => {
            this.editor.setContent(newVal);
            if (newVal) {
              unwatch();
            }
          });
        }
      });
    },
    handleRemove (file, fileList) {
      this.updateAttachments(fileList);
    },
    handleError (error, file) {
      console.log(error);
      this.$Notice.error({
        title: '出错了',
        desc: file.message
      });
    },
    handleSuccess (response, file, fileList) {
      this.updateAttachments(fileList);
    },
    updateAttachments (fileList) {
      let attachmentIds = fileList.map(item => {
        return item.response.attachment_id;
      });
      this.$emit('update:attachment_ids', attachmentIds);
    }
  },
  beforeDestroy () {
    try {
      this.editor.destroy();
    } catch (e) {
    } finally {
      this.editor = null;
    }
  },
  mounted () {
    this.initEditor();
  }
};
</script>

<style lang="less">
.ql-toolbar.ql-snow, .ql-container.ql-snow{
  border: none;
}
.ql-container .ql-editor {
  min-height: 320px;
  padding-bottom: 1em;
}
.article_wrapper {
  background-color: #fff;
  padding: 35px!important;
  padding-bottom: 20px!important;
  margin-bottom: 30px;
  .title_input_wrapper {
    margin-bottom: 30px;
  }
  .upload{
    margin-top: 10px;
  }
}
</style>
