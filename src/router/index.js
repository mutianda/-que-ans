import Vue from 'vue'
import Router from 'vue-router'
// import HelloWorld from '@/components/HelloWorld'
import Home from '@/page/index'
import Login from '@/page/login/Login'
import Ind from '@/components/Ind'
import HotQue from '@/components/HotQue'
import HotAns from '@/components/HotAns'
import MyQues from '@/components/MyQues'
import MyAns from '@/components/MyAns'
import Wirte from '@/components/Wirte'
import detail from '@/components/detail'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    }, {
      path: '/home',
      component: Home,
      meta: {
        title: '',
        requireAuth: true
      },
      children: [
        {
          path: 'index',
          component: Ind,
          meta: {
            title: '',
            requireAuth: true
          }
        },
        {
          path: 'hotque',
          meta: {
            title: '',
            requireAuth: true
          },
          component: HotQue
        }, {
          path: 'detail/:id',
          meta: {
            title: '',
            requireAuth: true
          },
          component: detail
        },
        {
          path: 'myques',
          component: MyQues
        },
        {
          path: 'hotans',
          meta: {
            title: '',
            requireAuth: true
          },
          component: HotAns
        },
        {
          path: 'myans',
          meta: {
            title: '',
            requireAuth: true
          },
          component: MyAns
        },
        {
          path: 'wirte',
          meta: {
            title: '',
            requireAuth: true
          },
          component: Wirte
        }
      ]
    }]
})
