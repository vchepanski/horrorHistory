<template>
    <div>
      <h1>🕯️ Histórias Publicadas</h1>
      <div class="cards">
        <div v-for="story in stories" :key="story.id" class="card">
          <router-link :to="`/historia/${story.id}`">
            <h3>{{ story.title }}</h3>
          </router-link>
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
    const response = await axios.get('/api/v1/stories')
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
  animation: fadeIn 1s ease;
}

.card {
  background: #111;
  border: 1px solid #333;
  padding: 1rem;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(255, 68, 68, 0.1);
  transition: all 0.3s ease;
  animation: cardEnter 0.8s ease forwards;
}

.card:hover {
  transform: scale(1.02);
  box-shadow: 0 0 20px rgba(255, 68, 68, 0.6);
  border-color: #ff4444;
}

.card h3 {
  color: #ff4444;
  font-family: 'Creepster', cursive;
}

.card p {
  color: #ccc;
}

.card img {
  max-width: 100%;
  margin-top: 1rem;
  border-radius: 6px;
  box-shadow: 0 0 10px #000;
}

/* Animações */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes cardEnter {
  0% {
    opacity: 0;
    transform: scale(0.95);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}
</style>

