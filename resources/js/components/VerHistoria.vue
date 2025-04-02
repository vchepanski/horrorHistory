<template>
    <div :style="filtroDeTela" class="historia-brilho">

      <!-- 🔊 Áudios -->
      <audio ref="doomPlayer" src="/audio/doom.mp3" autoplay loop :muted="muted" />
      <audio ref="velaAudio" src="/audio/vela.mp3" autoplay loop :muted="ambienteMuted" />

      <!-- ✅ Botões flutuantes empilhados no canto inferior direito -->
      <div class="stacked-buttons">
        <button @click="toggleAmbiente" title="Som ambiente vela">🕯️</button>
        <button @click="aumentarBrilho" title="Aumentar brilho">☀️</button>
        <button @click="diminuirBrilho" title="Diminuir brilho">🌙</button>
        <button class="mute-button" @click="toggleMute">
          {{ muted ? '🔇' : '🔊' }}
        </button>
      </div>

      <!-- 📜 Container principal da história -->
      <div class="historia-container" :style="{ fontSize: fontSize + 'rem' }">
        <!-- 🔄 Estado da história -->
        <div v-if="notFound" class="erro-box">
          <h1 class="erro">História não encontrada 😢</h1>
          <router-link class="voltar-link" to="/historias">← Voltar para lista</router-link>
        </div>

        <p v-else-if="!story" class="carregando">Carregando história...</p>

        <!-- ✅ Conteúdo da história -->
        <div v-else class="historia-card">
          <h1 class="titulo">{{ story.title }}</h1>
          <small class="categoria" v-if="story.category">
            🏷️ Categoria: {{ story.category.name }}
          </small>

          <div class="conteudo">
            {{ story.content }}
          </div>

          <img
            v-if="story.image"
            :src="'/storage/' + story.image"
            alt="Imagem da história"
            class="historia-imagem"
          />

          <router-link class="voltar-botao" to="/historias">← Voltar para histórias</router-link>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, onMounted, computed } from 'vue'
  import { useRoute } from 'vue-router'
  import axios from 'axios'

  const route = useRoute()
  const story = ref(null)
  const notFound = ref(false)

  // 🔊 Volume Doom (geral)
  const muted = ref(true)
  const toggleMute = () => muted.value = !muted.value

  // 🔊 Som ambiente vela
  const ambienteMuted = ref(true)
  const toggleAmbiente = () => ambienteMuted.value = !ambienteMuted.value

  // Fonte
  const fontSize = ref(1.1)

  // Brilho
  const brilho = ref(1)
  const aumentarBrilho = () => brilho.value = Math.min(brilho.value + 0.1, 1.5)
  const diminuirBrilho = () => brilho.value = Math.max(brilho.value - 0.1, 0.5)
  const filtroDeTela = computed(() => ({
    filter: `brightness(${brilho.value})`
  }))

  // Carregar história
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

  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=IM+Fell+English&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Creepster&display=swap');

  .historia-brilho {
    transition: filter 0.3s ease;
  }

  .historia-container {
    max-width: 900px;
    margin: 2rem auto;
    padding: 2rem;
    background: rgba(255, 248, 220, 0.96);
    border-radius: 16px;
    box-shadow: 0 0 80px 20px rgba(0, 0, 0, 0.4),
                inset 0 0 30px rgba(0, 0, 0, 0.1);
    font-family: 'IM Fell English', serif;
    color: #3b2b1a;
    line-height: 1.8;
    text-align: justify;
    position: relative;
  }

  .titulo {
    font-family: 'Creepster', cursive;
    font-size: 2.2rem;
    color: #7a1200;
    text-align: center;
    margin-bottom: 1rem;
    text-shadow: 1px 1px 0 #fff7ee, 2px 2px 3px #00000030;
  }

  .categoria {
    display: block;
    font-size: 0.95rem;
    color: #6b4c2d;
    margin-bottom: 1.5rem;
    text-align: center;
  }

  .conteudo {
    background: #fcf7e7;
    padding: 1.5rem;
    border-left: 5px solid #b88963;
    border-radius: 10px;
    box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
    color: #37291b;
    white-space: pre-line;
    word-break: break-word;
    text-indent: 2em;
  }

  .historia-imagem {
    display: block;
    max-width: 100%;
    margin: 2rem auto 1rem;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.4);
  }

  .voltar-botao {
    display: inline-block;
    margin-top: 2rem;
    padding: 0.5rem 1rem;
    background-color: #7a1200;
    color: #fffbe6;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: background 0.3s ease;
  }
  .voltar-botao:hover {
    background-color: #a82c10;
  }

  stacked-buttons {
  position: fixed;
  bottom: 80px; /* mais acima do botão de volume */
  right: 20px;
  display: flex;
  flex-direction: column-reverse;
  gap: 0.6rem;
  z-index: 9999;
}

.stacked-buttons button {
  background: #111;
  color: #ffe0c7;
  border: none;
  border-radius: 50%;
  font-size: 1.4rem;
  padding: 0.6rem;
  cursor: pointer;
  box-shadow: 0 0 10px rgba(0,0,0,0.4);
  transition: 0.3s;
}

.stacked-buttons button:hover {
  background: #7a1200;
  color: white;
}

.mute-button {
  background: #5a0000;
  color: #fff;
}

  /* erros */
  .erro-box {
    text-align: center;
    padding: 2rem;
    background-color: #fff4f4;
    border: 2px dashed red;
    border-radius: 12px;
  }
  .erro {
    font-size: 1.5rem;
    color: red;
    margin-bottom: 1rem;
  }
  .voltar-link {
    color: #7a1200;
    text-decoration: underline;
    font-weight: bold;
  }
  .carregando {
    text-align: center;
    font-style: italic;
    color: #555;
  }
  </style>
