<script setup>
defineProps({
  errorUsername: String,
  errorPassword: String,
  errorGeneral: String
})

const username = defineModel('username')
const password = defineModel('password')
const emit = defineEmits(['update:modelValue'])

const handleSubmit = () => {
  emit('submitForm')
}
</script>

<template>
  <form @submit.prevent="handleSubmit" class="card p-4">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input
        v-model.trim="username"
        type="text"
        class="form-control"
        id="username"
        name="username"
      />
      <div class="invalid-feedback" style="display: block">{{ errorUsername }}</div>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input
        v-model.trim="password"
        type="password"
        class="form-control"
        id="password"
        name="password"
      />
      <div class="invalid-feedback" style="display: block">{{ errorPassword }}</div>
      <div class="invalid-feedback mb-2" style="display: block">{{ errorGeneral }}</div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>

<style scoped>
form {
  width: 350px;
}
</style>
