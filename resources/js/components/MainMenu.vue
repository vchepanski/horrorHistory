<template>
    <nav class="navbar">
      <router-link to="/historias">📚 Histórias</router-link>
      <router-link to="/postar">✍️ Postar</router-link>
    </nav>
  </template>

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
  </style>
