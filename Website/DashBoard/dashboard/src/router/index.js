import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import User from '../views/User.vue'
import Main from '../views/Main.vue'

Vue.use(VueRouter)
// 创建路由组件
// 将路由与组件进行映射
// 创建router实例
const routes = [
    {
        path: '/',
        component: Main,
        children: [
            { path: 'Home', component: Home },
            { path: 'User', component: User }
        ]
    },
]

const router = new VueRouter({
        routes // (缩写) 相当于 routes: routes
    })

export default router



