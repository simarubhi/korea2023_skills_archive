<script setup>
import { RouterLink, RouterView, useRouter } from 'vue-router'

const router = useRouter()

import { globalState, apiRequest } from '@/state'

const signOut = async () => {
  await apiRequest('http://localhost:8000/api/v1/auth/signout', 'POST')

  globalState.isAuthenticated = false
  globalState.user = null

  router.push('/signout')
}
</script>

<template>
  <header>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
      <div class="d-flex justify-content-between container-lg">
        <RouterLink to="/" class="navbar-brand">WorldSkills: Games</RouterLink>
        <div v-if="!globalState.isAuthenticated" class="d-flex gap-3">
          <RouterLink to="/signup" class="btn btn-light">Signup</RouterLink>
          <RouterLink to="/signin" class="btn btn-secondary">Signin</RouterLink>
        </div>

        <div v-else class="d-flex gap-3 justify-content-cetner align-items-center fs-5 fw-medium">
          <span v-if="globalState.user" class="text-white">{{ globalState.user.username }}</span>
          <button role="button" @click.prevent="signOut" class="btn btn-danger">Signout</button>
        </div>
      </div>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped></style>
