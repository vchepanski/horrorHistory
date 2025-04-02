<template>
    <div class="ancient-wrapper" :style="filtroDeTela">
      <SplashScreen />

      <!-- Sons -->
      <audio ref="doomPlayer" src="/audio/doom.mp3" autoplay loop :muted="muted" />
      <audio ref="velaAudio" src="/audio/vela.wav" autoplay loop :muted="ambienteMuted" />

      <!-- 🔘 Botões flutuantes -->
      <div class="stacked-buttons">
        <button @click="toggleAmbiente" title="Som ambiente vela">🕯️</button>
        <button @click="aumentarBrilho" title="Aumentar brilho">☀️</button>
        <button @click="diminuirBrilho" title="Diminuir brilho">🌙</button>
        <button class="mute-button" @click="toggleMute">
          {{ muted ? '🔇' : '🔊' }}
        </button>
      </div>

      <!-- Menu -->
      <component :is="isAdminRoute ? AdminMenu : MainMenu" />

      <!-- Conteúdo -->
      <main class="ancient-scroll">
        <router-view v-slot="{ Component }">
          <transition name="fade" mode="out-in">
            <component :is="Component" />
          </transition>
        </router-view>
      </main>

      <footer class="ancient-footer" v-if="!isAdminRoute">
        <p>“As histórias aqui publicadas ecoam no escuro...”</p>
      </footer>
    </div>
  </template>

  <script setup>
  import { ref, computed } from 'vue'
  import { useRoute } from 'vue-router'

  import SplashScreen from '../components/SplashScreen.vue'
  import MainMenu from '../components/MainMenu.vue'
  import AdminMenu from '../views/Admin/AdminMenu.vue'

  const route = useRoute()
  const muted = ref(true)
  const ambienteMuted = ref(true)
  const brilho = ref(1)
  const filtroDeTela = computed(() => `filter: brightness(${brilho.value})`)

  const toggleMute = () => {
    muted.value = !muted.value
  }

  const toggleAmbiente = () => {
    ambienteMuted.value = !ambienteMuted.value
  }

  const aumentarBrilho = () => {
    if (brilho.value < 1.5) brilho.value += 0.1
  }

  const diminuirBrilho = () => {
    if (brilho.value > 0.3) brilho.value -= 0.1
  }

  const isAdminRoute = computed(() => route.path.startsWith('/admin'))
  </script>

  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=IM+Fell+English&display=swap');

  .ancient-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background: url('/images/pergaminho-textura.jpg') repeat;
    background-color: #f4e9d8;
    font-family: 'IM Fell English', serif;
    color: #3e2f1c;
  }

  .ancient-scroll {
    flex: 1;
    max-width: 900px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: rgba(255, 248, 220, 0.9);
    border: 2px solid #a3814c;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(77, 41, 0, 0.4);
  }

  .ancient-footer {
    text-align: center;
    padding: 2rem 1rem;
    font-style: italic;
    font-size: 1.1rem;
    color: #5a3d1f;
    background-color: #f0e2c3;
    border-top: 2px dashed #b19166;
    box-shadow: inset 0 5px 10px rgba(0,0,0,0.1);
  }

  .mute-button {
    background: #5a0000;
    color: #fff;
  }

  .stacked-buttons {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: flex;
    flex-direction: column-reverse;
    gap: 0.6rem;
    z-index: 10000;
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

  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.8s ease;
  }
  .fade-enter-from, .fade-leave-to {
    opacity: 0;
  }
  </style>
