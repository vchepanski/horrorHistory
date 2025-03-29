<template>
    <div class="layout-wrapper">
      <SplashScreen />
      <audio ref="doomPlayer" src="/audio/doom.mp3" autoplay loop :muted="muted" />
        <button class="mute-button" @click="toggleMute">
        {{ muted ? '🔇' : '🔊' }}
        </button>
      <nav class="navbar">
        <router-link to="/historias">📚 Histórias</router-link>
        <router-link to="/postar">✍️ Postar</router-link>
    </nav>
      <main class="container">
        <router-view v-slot="{ Component }">
    <transition name="fade" mode="out-in">
    <component :is="Component" />
    </transition>
</router-view>

      </main>

      <footer class="rodape-sombrio">
        <p>“As histórias aqui publicadas ecoam no escuro...”</p>
      </footer>
    </div>
  </template>

<script setup>
import { ref } from 'vue'

const muted = ref(true)

function toggleMute() {
  muted.value = !muted.value
}
import SplashScreen from '../components/SplashScreen.vue'
</script>

  <style scoped>
  .navbar {
    display: flex;
    justify-content: center;
    gap: 2rem;
    background: linear-gradient(to right, #111, #1a0000);
    padding: 1rem;
    font-weight: bold;
    font-size: 1.2rem;
    border-bottom: 2px solid #ff4444;
    box-shadow: 0 0 15px #8b0000;
  }

  .navbar a {
    color: #ff4444;
    text-decoration: none;
    font-family: 'Creepster', cursive;
    transition: 0.3s;
  }

  .navbar a:hover {
    color: #ff7777;
    text-shadow: 0 0 10px #ff0000;
  }

.layout-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* ocupa toda a altura da tela */
}

main.container {
  flex: 1; /* faz o main crescer e empurrar o footer pra baixo */
}
  .container {
  flex: 1;
  max-width: 900px;
  margin: 2rem auto;
  padding: 1rem;
  background-color: #0d0d0d;
  color: white;
  border-radius: 10px;
  box-shadow: 0 0 20px #111;
}
.rodape-sombrio {
  text-align: center;
  padding: 2rem 1rem;
  font-style: italic;
  font-size: 1rem;
  color: #ff4444;
  text-shadow: 0 0 10px #8b0000;
  background-color: #0a0a0a;
  border-top: 1px solid #222;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.8s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
.mute-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: #111;
  color: #ff4444;
  border: none;
  border-radius: 50%;
  font-size: 1.5rem;
  padding: 0.5rem 0.7rem;
  cursor: pointer;
  box-shadow: 0 0 10px #ff0000;
  z-index: 10000;
  transition: 0.3s;
}
.mute-button:hover {
  color: #fff;
  box-shadow: 0 0 15px #ff4444;
}

  </style>
