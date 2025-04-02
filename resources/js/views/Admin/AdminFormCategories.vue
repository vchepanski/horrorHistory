<template>
    <div> <!-- Root único para evitar erro com <Transition> -->

      <div class="max-w-xl p-6 mx-auto shadow-md bg-zinc-900 rounded-xl">
        <h2 class="mb-4 text-2xl font-bold text-white">Criar nova categoria</h2>

        <form @submit.prevent="submitCategory" class="space-y-4">
          <input
            v-model="form.name"
            type="text"
            placeholder="Nome da categoria"
            class="w-full p-3 text-white rounded bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-purple-600"
          />

          <button
            type="submit"
            class="w-full px-4 py-2 font-semibold text-white transition bg-purple-600 rounded hover:bg-purple-700"
          >
            Cadastrar
          </button>

          <p v-if="successMessage" class="text-green-400">{{ successMessage }}</p>
          <p v-if="errorMessage" class="text-red-400">{{ errorMessage }}</p>
        </form>

        <hr class="my-6 border-zinc-700" />

        <div>
          <h3 class="mb-4 text-xl font-semibold text-white">Categorias cadastradas</h3>
          <div class="space-y-2">
            <div
              v-for="category in categories"
              :key="category.id"
              class="flex items-center justify-between px-4 py-3 rounded shadow-sm bg-zinc-800"
            >
              <div class="text-zinc-200">
                {{ category.name }}
                <span
                  class="ml-2 text-xs px-2 py-0.5 rounded uppercase"
                  :class="category.status === 'ativo' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'"
                >
                  {{ category.status }}
                </span>
              </div>
              <button
                @click="toggleStatus(category.id)"
                class="px-3 py-1 text-sm text-white transition bg-purple-700 rounded hover:bg-purple-600"
              >
                {{ category.status === 'ativo' ? 'Inativar' : 'Ativar' }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'

  const form = ref({ name: '' })
  const successMessage = ref('')
  const errorMessage = ref('')
  const categories = ref([])

  const fetchCategories = async () => {
    try {
      const response = await axios.get('/api/v1/categories')
      categories.value = response.data
    } catch (error) {
      console.error('Erro ao carregar categorias', error)
    }
  }

  const submitCategory = async () => {
    successMessage.value = ''
    errorMessage.value = ''

    try {
      await axios.post('/api/v1/categories', form.value)
      successMessage.value = 'Categoria cadastrada com sucesso!'
      form.value.name = ''
      await fetchCategories()
    } catch (error) {
      errorMessage.value = 'Erro ao cadastrar categoria.'
      console.error(error)
    }
  }

  const toggleStatus = async (id) => {
    try {
      await axios.put(`/api/v1/categories/${id}/toggle-status`)
      await fetchCategories()
    } catch (error) {
      console.error('Erro ao atualizar status da categoria', error)
    }
  }

  onMounted(() => {
    fetchCategories()
  })
  </script>
