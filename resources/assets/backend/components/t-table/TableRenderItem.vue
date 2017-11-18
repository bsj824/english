<script>
  export default {
    props: {
      render: Function,
      params: Object
    },
    render (h) {
      return this.render(h, this.params);
    }
  };
</script>
