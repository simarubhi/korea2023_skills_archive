<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { getUser, globalState } from '@/state'

const router = useRouter()

const formData = reactive({
  username: '',
  password: ''
})

const errors = ref({
  username: '',
  password: '',
  general: ''
})

const signInCall = async () => {
  errors.value = {
    username: '',
    password: '',
    general: ''
  }

  try {
    const response = await fetch('http://localhost:8000/api/v1/auth/signin', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(formData)
    })

    const data = await response.json()

    if (response.ok) {
      localStorage.setItem('token', data.token)
      globalState.isAuthenticated = true

      await getUser(formData.username)

      router.push('/')
    } else if (data.status === 'invalid') {
      const violations = data.violations
      if (violations.username) {
        errors.value.username = `Username: ${violations.username.message}`
      }
      if (violations.password) {
        errors.value.password = `Password: ${violations.password.message}`
      }
      errors.value.general = data.message
    } else {
      errors.value.general = data.message || 'An error occurred during sign-up.'
    }
  } catch (error) {
    errors.value.general = 'Network error. Please try again later.'
  }
}
</script>

<template>
  <main
    class="container-lg d-flex flex-column justify-content-center align-items-center vw-100"
    style="height: 30vw"
  >
    <h1 class="mb-3">Sign In</h1>
    <form class="card p-4 needs-validation" @submit.prevent="signInCall" novalidate>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input
          type="text"
          v-model.trim="formData.username"
          class="form-control"
          id="username"
          name="username"
          required
        />
        <div class="text-danger" v-if="errors.username">{{ errors.username }}</div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          v-model.trim="formData.password"
          class="form-control"
          id="password"
          name="password"
        />
        <div class="text-danger" v-if="errors.password">{{ errors.password }}</div>
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a role="button" tabindex="0" @click="router.go(-1)" class="">Cancel</a>
      </div>
    </form>
  </main>
</template>

<style scoped>
form {
  width: 300px;
}
</style>
