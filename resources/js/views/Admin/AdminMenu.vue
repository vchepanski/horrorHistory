<template>
    <nav class="admin-navbar">
      <router-link to="/admin/historias">📚 Histórias (Admin)</router-link>
      <router-link to="/admin/categories">🏷️ Categorias</router-link>
    </nav>
  </template>

  <style scoped>
  .admin-navbar {
    display: flex;
    gap: 2rem;
    padding: 1rem 2rem;
    background-color: #111;
    border-bottom: 2px solid #ff4444;
    box-shadow: 0 0 15px #8b0000;
  }

  .admin-navbar a {
    color: #ff4444;
    font-weight: bold;
    font-family: 'Creepster', cursive;
    text-decoration: none;
    transition: 0.3s;
  }

  .admin-navbar a:hover {
    color: #fff;
    text-shadow: 0 0 10px #ff0000;
  }
  </style>
