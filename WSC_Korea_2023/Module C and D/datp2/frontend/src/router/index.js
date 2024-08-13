import { createRouter, createWebHistory } from 'vue-router'
import DiscoverGamesView from '../views/DiscoverGamesView.vue'
import SignupView from '@/views/SignupView.vue'
import SigninView from '@/views/SigninView.vue'
import SignoutView from '@/views/SignoutView.vue'
import { authApiRequest, globalState } from '@/state'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'discover-games',
      component: DiscoverGamesView,
      meta: {
        title: 'Discover Games',
        needAuth: 'all'
      }
    },
    {
      path: '/signup',
      name: 'signup',
      component: SignupView,
      meta: {
        title: 'Signup',
        needAuth: false
      }
    },
    {
      path: '/signin',
      name: 'signin',
      component: SigninView,
      meta: {
        title: 'Signin',
        needAuth: false
      }
    },
    {
      path: '/signout',
      name: 'signout',
      component: SignoutView,
      meta: {
        title: 'Signout',
        needAuth: 'all'
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

router.beforeEach(async (to, from, next) => {
  const token = localStorage.getItem('token')
  const username = localStorage.getItem('username')
  if (token && username && (!globalState.isAuth || !globalState.user)) {
    const user = await authApiRequest(`http://localhost:8000/api/v1/users/${username}`)

    globalState.isAuth = true
    globalState.user = user

    localStorage.setItem('username', user.username)
  } else {
    localStorage.removeItem('token')
    localStorage.removeItem('username')
  }

  if (to.meta.needAuth !== 'all') {
    if (to.meta.needAuth && !globalState.isAuth) {
      router.push('/signin')
    } else if (!to.meta.needAuth && globalState.isAuth) {
      router.push('/')
    }
  }

  document.title = to.meta.title || 'WorldSkills: Games'

  next()
})

export default router
