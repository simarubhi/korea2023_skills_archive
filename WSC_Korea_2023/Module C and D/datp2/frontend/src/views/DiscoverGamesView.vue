<script setup>
import { unAuthApiRequest } from '@/state'
import { onMounted, reactive, ref, watch, watchEffect } from 'vue'

const sort = localStorage.getItem('sort') || 'popular'
const order = localStorage.getItem('order') || 'asc'

const games = ref([])
const page = ref(0)
const size = ref(0)
const totalGames = ref(0)
const cardHeight = ref(350)
const loadingGames = ref(false)

const options = reactive({
  sort,
  order
})

const getGames = async () => {
  if (loadingGames.value) return

  loadingGames.value = true

  const params = new URLSearchParams({
    page: page.value,
    size: size.value,
    sortBy: options.sort,
    sortDir: options.order
  })

  const url = `http://localhost:8000/api/v1/games?${params.toString()}`

  const newGames = await unAuthApiRequest(url, 'GET')
  totalGames.value = newGames.totalElements
  games.value.push(...newGames.content)
  loadingGames.value = false
}

const calculateSize = () => {
  const viewportHeight = window.innerHeight
  size.value = Math.floor(viewportHeight / cardHeight.value)
}

const handleScroll = async () => {
  if (loadingGames.value) return
  const bottomOfWindow =
    window.innerHeight + window.scrollY >= document.documentElement.offsetHeight - 50
  if (bottomOfWindow) {
    page.value++
    await getGames()
  }
}

watch(options, async () => {
  if (size.value > 0 && !loadingGames.value) {
    localStorage.setItem('sort', options.sort)
    localStorage.setItem('order', options.order)
    games.value.splice(0)
    await getGames()
    getGames()
  }
})

onMounted(async () => {
  calculateSize()
  window.addEventListener('scroll', handleScroll)
  await getGames()
  getGames()
})
</script>

<template>
  <main class="d-flex justify-content-center align-items-center">
    <div class="mt-4 d-inline-flex flex-column gap-4">
      <div class="d-flex gap-5 justify-content-center align-items-center">
        <span class="fw-medium fs-2">{{ totalGames }} Games Available</span>
        <div class="d-flex gap-3 justify-content-between align-items-center">
          <span
            @click="options.sort = 'popular'"
            role="button"
            class="p-3"
            :class="{ 'bg-info bg-opacity-25': options.sort === 'popular' }"
            >Popularity</span
          >
          <span
            @click="options.sort = 'uploaddate'"
            role="button"
            class="p-3"
            :class="{ 'bg-info bg-opacity-25': options.sort === 'uploaddate' }"
            >Recently Updated</span
          >
          <span
            @click="options.sort = 'title'"
            role="button"
            class="p-3"
            :class="{ 'bg-info bg-opacity-25': options.sort === 'title' }"
            >Alphabetical</span
          >
        </div>
        <div class="d-flex gap-3 justify-content-between align-items-center">
          <span
            @click="options.order = 'asc'"
            role="button"
            class="p-3"
            :class="{ 'bg-info bg-opacity-25': options.order === 'asc' }"
            >ASC</span
          >
          <span
            @click="options.order = 'desc'"
            role="button"
            class="p-3"
            :class="{ 'bg-info bg-opacity-25': options.order === 'desc' }"
            >DESC</span
          >
        </div>
      </div>
      <div class="d-flex gap-3 flex-column justify-content-center align-items-center">
        <RouterLink
          v-for="(game, index) in games"
          :key="index"
          :to="game.slug"
          class="card container-fluid p-4 d-flex flex-column text-decoration-none"
          :style="`height: ${cardHeight}px`"
        >
          <div class="d-flex justify-content-between align-items-center">
            <div class="">
              <span class="fs-3 fw-medium">Game Title</span>
              <span class="ms-2">by {{ game.author }}</span>
            </div>
            <span class="fw-light"># Scores Submitted {{ game.scoreCount }}</span>
          </div>

          <div class="d-flex gap-3 align-items-center">
            <img
              class="img-thumbnail mt-1"
              style="max-height: 250px"
              src="../../public/thumbnail.jpg"
              :alt="`${game.title} thumbnail`"
            />

            <p class="w-100 h-100 mb-0">{{ game.description }}</p>
          </div>
        </RouterLink>
      </div>
    </div>
  </main>
</template>

<style scoped></style>

<!-- :src="//game.thumbnail ? `http://localhost:8000${game.thumbnail}` : 'example/src.png'" -->
