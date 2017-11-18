import Vue from 'vue';
import tHttp from './utils/tHttp';
import router from './router';
import App from './App.vue';
import iView from 'iview';
import 'iview/dist/styles/iview.css';
router.beforeEach((to, from, next) => {
  iView.LoadingBar.start();
  next();
});
router.afterEach((to, from, next) => {
  iView.LoadingBar.finish();
});

Vue.use(iView);

// 获取baseUrl
let base = window.location.pathname.split('backend')[0];
Vue.use(tHttp, {
  baseURL: base + 'api/backend/',
  router
});

new Vue({
  el: '#app',
  ...App,
  router
});
