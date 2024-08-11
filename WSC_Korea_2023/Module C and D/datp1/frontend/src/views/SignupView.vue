<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()
</script>

<template>
  <main
    class="container-lg d-flex justify-content-center align-items-center vw-100"
    style="height: 30vw"
  >
    <form class="card p-4">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required />
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
