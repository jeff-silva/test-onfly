<template>
  <div>
    <nuxt-page v-if="app.ready" />
    <div
      v-if="!app.ready"
      style="
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      "
    >
      <icon
        name="svg-spinners:180-ring-with-bg"
        size="100"
      />
    </div>
  </div>
</template>

<script setup>
const $q = useQuasar();
$q.dark.set(true);

const app = useApp();
app.init();
</script>
