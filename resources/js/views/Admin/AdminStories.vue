<template>
    <div class="admin-stories">
      <h1>📜 Gerenciar Histórias</h1>

      <div v-if="erro" class="erro">{{ erro }}</div>
      <div v-if="mensagem" class="mensagem">{{ mensagem }}</div>

      <table>
        <thead>
          <tr>
            <th>Título</th>
            <th>Categoria</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="story in historias" :key="story.id">
            <td>{{ story.title }}</td>
            <td>{{ story.category?.name || 'Sem categoria' }}</td>
            <td>
              <span v-if="story.is_published">✅ Publicada</span>
              <span v-else>⏳ Pendente</span>
            </td>
            <td>
              <button v-if="!story.is_published" @click="aprovar(story.id)">✅ Aprovar</button>
              <button @click="excluir(story.id)">🗑️ Excluir</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'

  const historias = ref([])
  const mensagem = ref('')
  const erro = ref('')

  async function carregarHistorias() {
    try {
      const { data } = await axios.get('/api/v1/admin/historias')
      historias.value = data
    } catch (e) {
      erro.value = 'Erro ao carregar histórias'
    }
  }

  async function aprovar(id) {
    try {
      await axios.put(`/api/v1/admin/historias/${id}/approve`)
      mensagem.value = 'História aprovada com sucesso!'
      await carregarHistorias()
    } catch (e) {
      erro.value = 'Erro ao aprovar história'
    }
  }

  async function excluir(id) {
    try {
      await axios.delete(`/api/v1/admin/historias/${id}`)
      mensagem.value = 'História excluída com sucesso!'
      await carregarHistorias()
    } catch (e) {
      erro.value = 'Erro ao excluir história'
    }
  }

  onMounted(() => {
    carregarHistorias()
  })
  </script>

  <style scoped>
  .admin-stories {
    max-width: 1000px;
    margin: 2rem auto;
    color: white;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
  }
  th, td {
    padding: 0.8rem;
    border-bottom: 1px solid #333;
  }
  button {
    background: #111;
    border: 1px solid #444;
    padding: 0.4rem 0.7rem;
    margin-right: 0.4rem;
    color: #ff4444;
    cursor: pointer;
  }
  button:hover {
    background: #222;
    color: #fff;
  }
  .erro {
    color: red;
    margin-bottom: 1rem;
  }
  .mensagem {
    color: green;
    margin-bottom: 1rem;
  }
  </style>
