export default {
  methods: {
    getConfig (key) {
      if (this.mixinConfig[key]) {
        return this.mixinConfig[key];
      } else {
        return this.defaultConfig[key];
      }
    }
  }
};
