<template>
    <div class="splash" v-if="show">
      <h1>Prepare-se para mergulhar no desconhecido...</h1>
    </div>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'

  const show = ref(true)

  onMounted(() => {
    setTimeout(() => {
      show.value = false
    }, 3000) // 3 segundos
  })
  </script>

  <style scoped>
  .splash {
    position: fixed;
    z-index: 9999;
    inset: 0;
    background-color: #000;
    display: flex;
    justify-content: center;
    align-items: center;
    animation: fadeOut 3s ease forwards;
  }

  .splash h1 {
    color: #ff4444;
    font-family: 'Creepster', cursive;
    font-size: 2rem;
    text-align: center;
    opacity: 1;
    animation: flicker 1.5s infinite alternate;
  }

  @keyframes fadeOut {
    0% {
      opacity: 1;
    }
    80% {
      opacity: 1;
    }
    100% {
      opacity: 0;
      visibility: hidden;
    }
  }

  @keyframes flicker {
    0% { text-shadow: 0 0 5px #ff0000; }
    100% { text-shadow: 0 0 20px #ff0000; }
  }
  </style>
