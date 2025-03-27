<template>
    <div>
      <h1>🕯️ Histórias Publicadas</h1>
      <div class="cards">
        <div v-for="story in stories" :key="story.id" class="card">
          <h3>{{ story.title }}</h3>
          <small v-if="story.category">Categoria: {{ story.category.name }}</small>
          <p>{{ story.content.substring(0, 100) }}...</p>
          <img v-if="story.image" :src="'/storage/' + story.image" alt="Capa da história" />
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'

  const stories = ref([])

  onMounted(async () => {
    try {
      const response = await axios.get('/api/stories')
      stories.value = response.data
    } catch (e) {
      console.error('Erro ao carregar histórias', e)
    }
  })
  </script>

  <style scoped>
  .cards {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-top: 2rem;
  }
  .card {
    background: #111;
    border: 1px solid #333;
    padding: 1rem;
    border-radius: 8px;
  }
  .card h3 {
    color: #ff4444;
  }
  .card img {
    max-width: 100%;
    margin-top: 1rem;
    border-radius: 6px;
  }
  </style>
