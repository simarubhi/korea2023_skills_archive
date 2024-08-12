import { createRouter, createWebHistory } from 'vue-router'
import DiscoverGamesView from '../views/DiscoverGamesView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'discover-games',
      component: DiscoverGamesView,
      meta: {
        title: 'Discover Games'
      }
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

router.beforeEach((to, from) => {})

export default router
