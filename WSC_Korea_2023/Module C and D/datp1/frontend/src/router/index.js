import { createRouter, createWebHistory } from 'vue-router'
import DiscoverView from '@/views/DiscoverView.vue'
import SignupView from '@/views/SignupView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Discover Games',
      component: DiscoverView,
      meta: { title: 'Discover Games' }
    },
    {
      path: '/signup',
      name: 'Signup',
      component: SignupView,
      meta: { title: 'Signup' }
    }
    // {
    // path: '/about',
    // name: 'about',
    // route level code-splitting
    // this generates a separate chunk (About.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    // component: () => import('../views/AboutView.vue')
    // }
  ]
})

export default router
