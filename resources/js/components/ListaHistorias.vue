<template>
    <div class="lista-container">
      <h1 class="titulo-lista">📜 Histórias Publicadas</h1>

      <div class="cards">
        <div v-for="story in stories" :key="story.id" class="card">
          <router-link :to="`/historia/${story.id}`">
            <h3 class="titulo-historia">{{ story.title }}</h3>
          </router-link>

          <small v-if="story.category" class="categoria">
            🏷️ Categoria: {{ story.category.name }}
          </small>

          <p class="resumo">
            {{ story.content.length > 300 ? story.content.slice(0, 300) + '...' : story.content }}
          </p>

          <img
            v-if="story.image"
            :src="'/storage/' + story.image"
            alt="Capa da história"
            class="imagem"
          />
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
  @import url('https://fonts.googleapis.com/css2?family=IM+Fell+English&display=swap');

  .lista-container {
    max-width: 900px;
    margin: 2rem auto;
    padding: 1.5rem;
    background: rgba(255, 248, 220, 0.95);
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(77, 41, 0, 0.4);
    font-family: 'IM Fell English', serif;
    color: #3e2f1c;
  }

  .titulo-lista {
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    text-align: center;
    color: #7a1200;
  }

  .cards {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }

  .card {
    background: #1a1208;
    padding: 1.2rem;
    border-radius: 10px;
    border: 2px solid #3b2a1a;
    box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.05), 0 0 15px rgba(0, 0, 0, 0.4);
    transition: 0.3s ease;
  }

  .card:hover {
    transform: translateY(-3px);
    border-color: #ff4444;
    box-shadow: 0 0 20px rgba(255, 68, 68, 0.3);
  }

  .titulo-historia {
    font-size: 1.4rem;
    font-family: 'Creepster', cursive;
    color: #ff4444;
    margin-bottom: 0.4rem;
  }

  .categoria {
    display: block;
    font-size: 0.85rem;
    color: #cbb68f;
    margin-bottom: 0.6rem;
  }

  .resumo {
    color: #f0e6d2;
    font-size: 0.95rem;
    line-height: 1.5;
    white-space: normal;
    word-break: break-word;
  }

  .imagem {
    max-width: 100%;
    margin-top: 1rem;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.6);
  }
  </style>
