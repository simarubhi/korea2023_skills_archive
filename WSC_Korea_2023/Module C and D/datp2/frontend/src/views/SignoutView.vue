<script setup>
import { onBeforeMount } from 'vue'
import { authApiRequest, globalState } from '@/state'
import { useRouter } from 'vue-router'
const router = useRouter()

onBeforeMount(async () => {
  if (!globalState.isAuth) {
    router.push('/')
  } else {
    // Revoke token
    await authApiRequest('http://localhost:8000/api/v1/auth/signout', 'POST')
    localStorage.removeItem('token')
    globalState.isAuth = false
    globalState.user = null
  }
})
</script>

<template>
  <main>
    <div class="d-flex flex-column gap-4 justify-content-center align-items-center mt-5">
      <h1>Sign out</h1>
      <div class="card">
        <span class="fs-4 fw-medium p-4">You have been successfully signed out.</span>
      </div>
    </div>
  </main>
</template>

<style scoped>
.card {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 300px;
}
</style>
