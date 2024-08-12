import './assets/main.css'
import './assets/main'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

const app = createApp(App)

router.beforeEach((to, from, next) => {
  const defaultTitle = 'WorldSkills: Games'
  document.title = to.meta.title || defaultTitle
  next()
})

app.use(router)

app.mount('#app')
