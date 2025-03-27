<template>
    <div>
      <h1>👻 Histórias de Terror</h1>
      <p>{{ mensagem }}</p>

      <ListaDeHistorias />
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';
  import ListaDeHistorias from './components/ListaDeHistorias.vue';

  const mensagem = ref('Bem-vindo ao mundo sombrio!');
  </script>

  <style scoped>
  h1 {
    color: #8b0000;
    text-align: center;
  }
  p {
    text-align: center;
  }
  </style>
