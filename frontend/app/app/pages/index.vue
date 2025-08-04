<template>
  <nuxt-layout name="app">
    <div>Bem Vindo {{ app.user.name }}</div>
  </nuxt-layout>
</template>

<script setup>
const app = useApp();
</script>
