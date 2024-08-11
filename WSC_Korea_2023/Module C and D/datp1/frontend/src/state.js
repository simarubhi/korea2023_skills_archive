import { reactive } from 'vue'

export const globalState = reactive({
  user: null,
  isAuthenticated: false
})
