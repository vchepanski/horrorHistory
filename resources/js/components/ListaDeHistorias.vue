<template>
    <div>
      <CardHistoria
        v-for="(item, index) in historias"
        :key="index"
        :historia="item"
      />
    </div>
  </template>

  <script setup>
  import CardHistoria from './CardHistoria.vue';

  const historias = [
    { titulo: 'A Sombra da Floresta', resumo: 'Algo espreita entre as árvores...' },
    { titulo: 'O Espelho Quebrado', resumo: 'Reflexos que não deviam existir.' },
    { titulo: 'Chamado na Madrugada', resumo: 'O telefone toca... e ninguém responde.' },
  ];
  </script>
