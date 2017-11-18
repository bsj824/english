import Vue from 'vue';
import Router from 'vue-router';
// 获取baseUrl
let base = window.location.pathname.split('backend')[0] + 'backend';
Vue.use(Router);
const router = new Router({
  mode: 'history',
  base,
  routes: [
    {
      path: '*',
      redirect: {name: 'home'}
    },
    {
      path: '/login',
      name: 'login',
      component: require('./views/Login.vue'),
      beforeEnter: (to, from, next) => {
        if (localStorage.getItem('login_ok')) {
          let redirect = to.query.redirect;
          if (redirect) {
            next({path: redirect});
          } else {
            next({name: 'home'});
          }
        } else {
          next();
        }
      }
    },
    {
      path: '/',
      component: require('./views/Home.vue'),
      meta: { requiresAuth: true },
      children: [
        {
          path: '',
          name: 'home',
          component: require('./views/Overview.vue')
        },
        {
          path: 'user/list',
          name: 'userList',
          component: require('./views/user/UserList.vue')
        },
        {
          path: 'user/add',
          name: 'addUser',
          meta: {
            isAdd: true
          },
          component: require('./views/user/User.vue')
        },
        {
          path: 'user/:id/edit',
          name: 'editUser',
          meta: {
            isAdd: false
          },
          component: require('./views/user/User.vue')
        },
        {
          path: 'article/list/:id?',
          name: 'articleList',
          component: require('./views/article/ArticleList.vue')
        },
        {
          path: 'article/:id/edit',
          name: 'editArticle',
          meta: {
            isAdd: false
          },
          component: require('./views/article/Article.vue')
        },
        {
          path: 'article/add',
          name: 'addArticle',
          meta: {
            isAdd: true
          },
          component: require('./views/article/Article.vue')
        },
        {
          path: 'column/list',
          name: 'columnList',
          component: require('./views/column/ColumnList.vue')
        },
        {
          path: 'column/:id/page',
          name: 'page',
          component: require('./views/column/Page.vue')
        },
        {
          path: 'column/:id/edit',
          name: 'editColumn',
          meta: {
            isAdd: false
          },
          component: require('./views/column/Column.vue')
        },
        {
          path: 'column/add',
          name: 'addColumn',
          meta: {
            isAdd: true
          },
          component: require('./views/column/Column.vue')
        },
        {
          path: 'banner/list/:typeName?',
          name: 'bannerList',
          component: require('./views/banner/BannerList.vue')
        },
        {
          path: 'banner/add',
          name: 'addBanner',
          meta: {
            isAdd: true
          },
          component: require('./views/banner/Banner.vue')
        },
        {
          path: 'banner/:id/edit',
          name: 'editBanner',
          meta: {
            isAdd: false
          },
          component: require('./views/banner/Banner.vue')
        },
        {
          path: 'role/list',
          name: 'roleList',
          component: require('./views/role/RoleList.vue')
        },
        {
          path: 'role/add',
          name: 'addRole',
          meta: {
            isAdd: true
          },
          component: require('./views/role/Role.vue')
        },
        {
          path: 'role/:id/edit',
          name: 'editRole',
          meta: {
            isAdd: false
          },
          component: require('./views/role/Role.vue')
        },
        {
          path: 'link/list/:typeName?',
          name: 'linkList',
          component: require('./views/link/LinkList.vue')
        },
        {
          path: 'link/add',
          name: 'addLink',
          meta: {
            isAdd: true
          },
          component: require('./views/link/Link.vue')
        },
        {
          path: 'link/:id/edit',
          name: 'editLink',
          meta: {
            isAdd: false
          },
          component: require('./views/link/Link.vue')
        },
        {
          path: 'tag/list/',
          name: 'tagList',
          component: require('./views/tag/TagList.vue')
        },
        {
          path: 'tag/add',
          name: 'addTag',
          meta: {
            isAdd: true
          },
          component: require('./views/tag/Tag.vue')
        },
        {
          path: 'tag/:id/edit',
          name: 'editTag',
          meta: {
            isAdd: false
          },
          component: require('./views/tag/Tag.vue')
        },
        {
          path: 'setting/:id/edit',
          name: 'editSetting',
          meta: {
            isAdd: false
          },
          component: require('./views/setting/Setting.vue')
        },
        {
          path: 'setting/add',
          name: 'addSetting',
          meta: {
            isAdd: true
          },
          component: require('./views/setting/Setting.vue')
        },
        {
          path: 'setting/list',
          name: 'settingList',
          component: require('./views/setting/SettingList.vue')
        }
      ]
    }
  ]
});
router.afterEach((to, from) => {
  setTimeout(() => {
    try {
      let component = document.title = to.matched[to.matched.length - 1].instances.default;
      if (component.title) {
        document.title = component.title + '-tiny';
      } else {
        document.title = component.mixinConfig.title + '-tiny';
      }
    } catch (e) {
      document.title = 'tiny';
    }
  }, 0);
});
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!localStorage.getItem('login_ok')) {
      next({
        name: 'login',
        query: { redirect: to.fullPath }
      });
    } else {
      next();
    }
  } else {
    next();
  }
});
export default router;
