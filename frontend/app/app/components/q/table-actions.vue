<template>
  <div>
    <q-btn icon="menu">
      <q-menu
        anchor="center left"
        self="center right"
      >
        <div style="display: flex; align-items: center; gap: 10px">
          <template v-for="o in actions">
            <q-btn v-bind="o" />
          </template>
        </div>
      </q-menu>
    </q-btn>
  </div>
</template>

<script setup>
const props = defineProps({
  actions: { type: Array, default: () => [] },
});

const actions = computed(() => {
  return props.actions.map((act) => {
    return { label: "", ...act };
  });
});
</script>
