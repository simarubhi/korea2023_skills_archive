import { createRouter, createWebHistory } from 'vue-router'
import DiscoverView from '@/views/DiscoverView.vue'
import SignupView from '@/views/SignupView.vue'
import SigninView from '@/views/SigninView.vue'
import SignoutView from '@/views/SignoutView.vue'

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
    },
    {
      path: '/signin',
      name: 'Signin',
      component: SigninView,
      meta: { title: 'Signin' }
    },
    {
      path: '/signout',
      name: 'Signout',
      component: SignoutView,
      meta: { title: 'Signout' }
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
