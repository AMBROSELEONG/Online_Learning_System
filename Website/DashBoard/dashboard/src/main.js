import Vue from 'vue'
import App from './App.vue'
import './plugins/element.js'
import './assets/css/dashboard.css'
import router from './router'
import ElementUI from 'element-ui'

Vue.config.productionTip = false

Vue.use(ElementUI)

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
