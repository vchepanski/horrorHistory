<template>
    <div v-if="notFound">
      <h1 style="color: red">História não encontrada 😢</h1>
      <router-link to="/historias">← Voltar para lista</router-link>
    </div>

    <div v-else-if="story">
      <h1>{{ story.title }}</h1>
      <small v-if="story.category">Categoria: {{ story.category.name }}</small>
      <p style="margin-top: 1rem;">{{ story.content }}</p>
      <img v-if="story.image" :src="'/storage/' + story.image" alt="Imagem" style="max-width: 100%; margin-top: 1rem;" />
    </div>

    <p v-else>Carregando...</p>
  </template>


  <script setup>
 import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const story = ref(null)
const notFound = ref(false)

onMounted(async () => {
  try {
    const response = await axios.get(`/api/v1/story/${route.params.id}`)
    story.value = response.data
  } catch (e) {
    console.error('Erro ao carregar história', e)
    notFound.value = true
  }
})

  </script>
