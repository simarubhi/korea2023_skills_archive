import { reactive } from 'vue'
import { useRouter } from 'vue-router'

export const globalState = reactive({
  user: null,
  isAuth: false
})

export const unAuthApiRequest = async (path, method = 'GET', body = null) => {
  const options = {
    method,
    headers: {
      'Content-Type': 'application/json'
    }
  }

  if (body) {
    options.body = JSON.stringify(body)
  }

  try {
    const response = await fetch(path, options)
    const data = await response.json()

    if (data.status == 'success' || data.status == 'invalid') {
      return data
    } else if (!response.ok) {
      throw new Error(data.message || 'API request failed')
    }

    return data
  } catch (error) {
    console.error('Error in unAuthApiRequest:', error.message)
    throw error
  }
}

export const authApiRequest = async (path, method = 'GET', body = null) => {
  const token = localStorage.getItem('token')
  if (!token) {
    throw new Error('No authentication token found')
  }

  const options = {
    method,
    headers: {
      'Content-Type': 'application/json',
      Authorization: `Bearer ${token}`
    }
  }

  if (body) {
    options.body = JSON.stringify(body)
  }

  try {
    const response = await fetch(path, options)
    const data = await response.json()

    if (data.status == 'success' || data.status == 'invalid') {
      return data
    } else if (!response.ok) {
      if (response.status === 401) {
        globalState.isAuth = false
        globalState.user = null
        localStorage.removeItem('token')

        alert('You are no longer logged in')
        const router = useRouter()

        router.push('/')
      }
      throw new Error(data.message || 'API request failed')
    }

    return data
  } catch (error) {
    console.error('Error in authApiRequest:', error.message)
    throw error
  }
}
