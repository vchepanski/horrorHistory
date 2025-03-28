<template>
    <div>
      <h1>👻 Postar Nova História</h1>
      <form @submit.prevent="enviarHistoria" enctype="multipart/form-data" class="formulario">
        <div>
          <label>Título:</label>
          <input type="text" v-model="form.title" required />
        </div>

        <div>
          <label>Conteúdo:</label>
          <textarea v-model="form.content" rows="6" required></textarea>
        </div>

        <div>
          <label>Categoria:</label>
          <select v-model="form.category_id" required>
            <option disabled value="">Selecione uma categoria</option>
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
              {{ categoria.name }}
            </option>
          </select>
        </div>

        <div>
          <label>Imagem:</label>
          <input type="file" @change="handleImagem" required />
        </div>

        <div>
          <label>
            <input type="checkbox" v-model="form.is_published" />
            Publicar
          </label>
        </div>

        <button type="submit">Postar História</button>

        <p v-if="mensagem" style="color: green">{{ mensagem }}</p>
        <p v-if="erro" style="color: red">{{ erro }}</p>
      </form>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'

  const form = ref({
    title: '',
    content: '',
    category_id: '',
    is_published: false,
    image: null,
  })

  const categorias = ref([])
  const mensagem = ref('')
  const erro = ref('')

  onMounted(async () => {
    try {
      const response = await axios.get('/api/v1/categories') // ✅ Atualizado
      categorias.value = response.data
    } catch (e) {
      erro.value = 'Erro ao carregar categorias'
    }
  })

  function handleImagem(e) {
    form.value.image = e.target.files[0]
  }

  async function enviarHistoria() {
    mensagem.value = ''
    erro.value = ''

    const payload = new FormData()
    for (const key in form.value) {
      payload.append(key, form.value[key])
    }

    try {
      await axios.post('/api/v1/story', payload, { // ✅ Atualizado
        headers: { 'Content-Type': 'multipart/form-data' },
      })
      mensagem.value = 'História enviada com sucesso!'
      form.value = {
        title: '',
        content: '',
        category_id: '',
        is_published: false,
        image: null,
      }
    } catch (e) {
      erro.value = 'Erro ao enviar a história.'
    }
  }
  </script>
