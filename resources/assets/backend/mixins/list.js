export default{
  props: {
    title: String,
    queryName: String,
    pageSize: {
      type: Number,
      default: 10
    }
  },
  data () {
    return {
      keyword: '',
      searchScope: 'all',
      total: 0,
      perPage: this.pageSize,
      currentPage: 1,
      allowSearchFields: [],
      allowSortFields: [],
      delayTimer: null,
      list: [],
      loading: false
    };
  },
  mounted () {
    this.getList();
  },
  watch: {
    'keyword' () {
      if (this.delayTimer === null) {
        this.delayTimer = setTimeout(() => {
          this.getList(1, this.keyword, this.searchScope);
          clearTimeout(this.delayTimer);
          this.delayTimer = null;
        }, 300);
      }
    },
    'queryName' () {
      this.getList();
    },
    'perPage' () {
      this.getList();
    }
  },
  methods: {
    getTitle (key) {
      if (this.$parent.colums) {
        let col = this.$parent.colums.find(item => item.key === key);
        return col ? col.title : key;
      }
    },
    refresh () {
      this.$nextTick(() => {
        this.getList(this.currentPage);
      });
    },
    getList (page = 1, keyword = '', searchScope) {
      if (this.queryName) {
        this.loading = true;
        this.$emit('update:loading', true);
        this.$http.get(this.queryName, {
          params: {
            per_page: this.perPage,
            page,
            search_scope: searchScope,
            keywords: keyword
          }
        }).then(res => {
          this.$emit('update:loading', false);
          this.loading = false;
          this.list = res.data.data;
          this.total = res.data.meta.pagination.total;
          this.allowSortFields = res.data.meta.allow_sort_fields;
          this.allowSearchFields = res.data.meta.allow_search_fields;
        }).catch(() => {
          this.$emit('update:loading', false);
          this.loading = false;
        });
      }
    },
    change (currentPage) {
      this.getList(currentPage);
    }
  }
};
