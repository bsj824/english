import delMixin from './del';
import draggable from 'vuedraggable';
import TypeManagement from '../components/TypeManagement.vue';
import NoData from '../components/NoData.vue';
import DraggableRow from '../components/DraggableRow.vue';
import mixinConfig from './mixinConfig';
export default {
  mixins: [ delMixin, mixinConfig ],
  components: { draggable, TypeManagement, NoData, DraggableRow },
  watch: {
    'typeName' () {
      this.$router.push({name: this.$route.name, params: {typeName: this.typeName}});
      this.getList();
    }
  },
  methods: {
    getList () {
      this.$http.get(this.getConfig('action'), {
        params: {
          'type_name': this.typeName
        }
      }).then(res => {
        this.list = res.data.data;
      });
    },
    reSort (event) {
      if (event.newIndex === event.oldIndex) {
        return;
      }
      this.$http.post('settings/index_order', {
        index_order: this.list.map(item => item.id),
        model: this.model
      }).then(res => {
        this.$Message.success('排序成功');
      });
    },
    refreshType () {
      this.$http.get('types', {
        params: {
          model: this.model
        }
      }).then(res => {
        this.types = res.data.data;
      });
    }
  },
  data () {
    return {
      typeName: null,
      types: [],
      list: [],
      showTypeManagementDialog: false,
      model: '',
      defaultConfig: {
        action: null
      }
    };
  },
  mounted () {
    let url = this.getConfig('action');
    this.model = url.substring(0, url.length - 1);
    this.$http.get('types', {
      params: {
        model: this.model
      }
    }).then(res => {
      this.types = res.data.data;
      let typeName = this.$route.params.typeName;
      if (typeName !== undefined && this.types.some(item => item.name === typeName)) {
        this.typeName = typeName;
      } else if (this.types[0]) {
        this.typeName = this.types[0].name;
      }
    });
    this.$on('del-success', this.getList);
  }
};
