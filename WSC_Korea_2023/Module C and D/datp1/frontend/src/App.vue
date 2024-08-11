<script setup>
import { RouterLink, RouterView } from 'vue-router'

import { globalState } from '@/state'
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

        <div v-else class="d-flex gap-3">
          <span>{{ globalState.user }}</span>
          <RouterLink to="/signout" class="btn btn-danger">Signout</RouterLink>
        </div>
      </div>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped></style>
