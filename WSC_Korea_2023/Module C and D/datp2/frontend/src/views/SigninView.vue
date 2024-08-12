<script setup>
import AuthForm from '@/components/AuthForm.vue'
import { reactive } from 'vue'
import { authApiRequest, globalState, unAuthApiRequest } from '@/state'
import { useRouter } from 'vue-router'

const router = useRouter()

const formData = reactive({
  username: '',
  password: ''
})

const errors = reactive({
  general: ''
})

const handleSubmit = async () => {
  const data = await unAuthApiRequest('http://localhost:8000/api/v1/auth/signin', 'POST', formData)

  if (data.message) {
    errors.general = data.message
  } else {
    globalState.isAuth = true

    localStorage.setItem('token', data.token)

    const user = await authApiRequest(`http://localhost:8000/api/v1/users/${formData.username}`)

    globalState.user = user
    localStorage.setItem('username', user.username)

    router.push('/')
  }
}
</script>

<template>
  <main>
    <div class="d-flex flex-column gap-4 justify-content-center align-items-center mt-5">
      <h1>Signin</h1>
      <AuthForm
        v-model:username="formData.username"
        v-model:password="formData.password"
        :errorGeneral="errors.general"
        @submitForm="handleSubmit"
      />
    </div>
  </main>
</template>
