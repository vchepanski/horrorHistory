<template>
    <div class="card">
      <h3>{{ historia.titulo }}</h3>
      <p>{{ historia.resumo }}</p>
    </div>
  </template>

  <script setup>
  defineProps(['historia']);
  </script>

  <style scoped>
  .card {
    border: 1px solid #444;
    padding: 1rem;
    border-radius: 8px;
    margin: 10px;
    background: #111;
    color: #eee;
  }
  </style>
