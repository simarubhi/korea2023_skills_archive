import { reactive } from 'vue'
import { useRouter } from 'vue-router'

export const globalState = reactive({
  user: null,
  isAuthenticated: false
})

export const apiRequest = async (endpoint, method = 'GET', body = null) => {
  if (!globalState.isAuthenticated || !localStorage.getItem('token')) return

  const router = useRouter()
  const token = localStorage.getItem('token')

  const headers = {
    'Content-Type': 'application/json',
    Authorization: `Bearer ${token}`
  }

  const options = {
    method,
    headers
  }

  if (body) {
    options.body = JSON.stringify(body)
  }

  try {
    const response = await fetch(endpoint, options)

    if (response.status === 401) {
      globalState.isAuthenticated = false
      // Token is expired or invalid
      localStorage.removeItem('token') // Clear the stored token
      alert('Your session has expired. Please log in again.')
      router.push('/signin') // Redirect to the login page
      return
    }

    if (!response.ok) {
      const errorData = await response.json()
      throw new Error(errorData.message || 'API request failed')
    }

    return await response.json()
  } catch (error) {
    console.error('API Request Error:', error.message)
    throw error
  }
}

export const getUser = async (username) => {
  globalState.user = null
  const user = await apiRequest(`http://localhost:8000/api/v1/users/${username}`)
  globalState.user = user
}
