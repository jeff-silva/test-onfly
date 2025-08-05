<template>
  <q-card-actions
    v-if="actions.length > 0"
    align="right"
    style="display: flex; align-items: center"
  >
    <template v-for="o in actions">
      <q-btn v-bind="o" />
    </template>
  </q-card-actions>
</template>

<script setup>
const props = defineProps({
  actions: { type: Array, default: () => [] },
});

const actions = computed(() => {
  return props.actions
    .map((act) => {
      return { label: "", showIf: () => true, ...act };
    })
    .filter((act) => act.showIf());
});
</script>
