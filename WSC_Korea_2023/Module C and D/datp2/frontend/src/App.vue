<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { globalState } from './state'
</script>

<template>
  <header>
    <nav class="navbar bg-primary">
      <div class="container-xxl d-flex justify-content-between align-items-center">
        <RouterLink to="/" class="navbar-brand text-white fs-3 fw-medium"
          >WorldSkills: Games</RouterLink
        >

        <div class="d-flex gap-3 justify-content-between align-items-center">
          <RouterLink v-if="!globalState.isAuth" to="/signup" class="btn btn-light"
            >Signup</RouterLink
          >
          <RouterLink v-if="!globalState.isAuth" to="/signin" class="btn btn-secondary"
            >Signin</RouterLink
          >
          <span v-if="globalState.isAuth" class="text-white fw-4 fw-medium">{{
            globalState.user.username
          }}</span>
          <RouterLink v-if="globalState.isAuth" to="/signout" class="btn btn-danger"
            >Signout</RouterLink
          >
        </div>
      </div>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped></style>
