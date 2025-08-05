<template>
  <nuxt-layout name="app">
    <div v-if="app.user">Bem Vindo {{ app.user.name }}</div>
  </nuxt-layout>
</template>

<script setup>
const app = useApp();
</script>
