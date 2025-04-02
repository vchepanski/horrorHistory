<template>
    <div class="historia-wrapper">
      <h1 class="titulo">{{ historia.titulo }}</h1>

      <div class="resumo-box">
        <p class="resumo">{{ historia.resumo }}</p>
      </div>
    </div>
  </template>

  <script setup>
  defineProps(['historia'])
  </script>

  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=IM+Fell+English&display=swap');

  .historia-wrapper {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: rgba(255, 248, 220, 0.95);
    border-radius: 16px;
    box-shadow: 0 0 30px rgba(77, 41, 0, 0.4);
    font-family: 'IM Fell English', serif;
    color: #3b2b17;
    line-height: 1.7;
    text-align: justify;
    position: relative;
  }

  .titulo {
    font-family: 'Creepster', cursive;
    color: #7a1200;
    font-size: 2rem;
    text-align: center;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 0 #f8f0e6, 2px 2px 2px #00000044;
  }

  .resumo-box {
    padding: 1.5rem;
    background-color: #fcf7e9;
    border-left: 5px solid #c1976b;
    border-radius: 8px;
    box-shadow: inset 0 0 8px rgba(0, 0, 0, 0.1);
  }

  .resumo {
    font-size: 1.05rem;
    color: #37291b;
    white-space: pre-line;
    text-indent: 2em;
  }
  </style>
