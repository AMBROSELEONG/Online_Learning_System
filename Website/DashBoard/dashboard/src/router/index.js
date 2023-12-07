import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import User from '../views/User.vue'
import Main from '../views/Main.vue'
import Course from '../views/Course.vue'
import PageOne from '../views/PageOne.vue'
import PageTwo from '../views/PageTwo.vue'

Vue.use(VueRouter)
// 创建路由组件
// 将路由与组件进行映射
// 创建router实例
const routes = [
    {
        path: '/',
        component: Main,
        redirect:'/home',
        children: [
            { path: 'home', component: Home },
            { path: 'course', component: Course },
            { path: 'user', component: User },
            { path: 'page1', component: PageOne },
            { path: 'page2', component: PageTwo },
        ]
    },
]

const router = new VueRouter({
        routes // (缩写) 相当于 routes: routes
    })

export default router



