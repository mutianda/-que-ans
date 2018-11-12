// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import './assets/icon/iconfont.css'
import App from './App'
import router from './router'
import FastClick from 'fastclick'
Vue.use(ElementUI)
Vue.config.productionTip = false
FastClick.attach(document.body)

/* eslint-disable */
router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth) {
    const username = window.localStorage.getItem('username')
    if (username == '' || !username) {
      next({
        path: '/login',
        query: {redirect: to.fullPath}
      })
    } else {
      next()
    }
  } else {
    next()
  }
})
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
