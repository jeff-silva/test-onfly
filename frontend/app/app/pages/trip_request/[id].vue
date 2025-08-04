<template>
  <nuxt-layout name="app">
    <q-form @submit.prevent="save.submit()">
      <q-input
        v-model="save.data.name"
        label="Nome do solicitante"
        :error-message="save.fieldError('name')"
        :error="!!save.fieldError('name')"
      />
      <q-input
        v-model="save.data.destination"
        label="Destino"
        :error-message="save.fieldError('destination')"
        :error="!!save.fieldError('destination')"
      />

      <q-input
        :model-value="f.date(save.data.departure_date)"
        label="Data de partida"
        readonly
        :error-message="save.fieldError('departure_date')"
        :error="!!save.fieldError('departure_date')"
      >
        <template #append>
          <q-icon
            name="event"
            class="cursor-pointer"
          >
            <q-popup-proxy
              cover
              transition-show="scale"
              transition-hide="scale"
            >
              <q-date
                v-model="save.data.departure_date"
                mask="YYYY-MM-DD"
              />
            </q-popup-proxy>
          </q-icon>
        </template>
      </q-input>

      <q-input
        :model-value="f.date(save.data.return_date)"
        label="Data de retorno"
        readonly
        :error-message="save.fieldError('return_date')"
        :error="!!save.fieldError('return_date')"
      >
        <template #append>
          <q-icon
            name="event"
            class="cursor-pointer"
          >
            <q-popup-proxy
              cover
              transition-show="scale"
              transition-hide="scale"
            >
              <q-date
                v-model="save.data.return_date"
                mask="YYYY-MM-DD"
              />
            </q-popup-proxy>
          </q-icon>
        </template>
      </q-input>

      <q-card-actions align="right">
        <q-btn
          type="submit"
          :loading="save.busy"
        >
          Salvar
        </q-btn>
      </q-card-actions>
    </q-form>

    <q-page-sticky
      position="bottom-right"
      class="q-pa-md"
    >
      <q-fab
        color="primary"
        icon="keyboard_arrow_up"
        direction="up"
      >
        <q-fab-action
          color="primary"
          icon="arrow_back"
          to="/trip_request"
        />
      </q-fab>
    </q-page-sticky>
  </nuxt-layout>
</template>

<script setup>
const f = useFormat();
const route = useRoute();
const router = useRouter();

const save = useAxios({
  method: "post",
  url: "/api/trip_request",
  init() {
    save.method = "post";
    save.url = `/api/trip_request`;

    const id = route.params.id;
    if (isNaN(id)) return;
    save.method = "put";
    save.url = `/api/trip_request/${id}`;
  },
  onSuccess() {
    router.push(`/trip_request/${save.response.entity.id}`);
  },
});

const select = useAxios({
  method: "get",
  url: "/api/trip_request/:id",
  init() {
    const id = route.params.id;
    if (isNaN(id)) return;
    select.url = `/api/trip_request/${id}`;
    select.submit();
  },
  onSuccess() {
    save.data = select.response.entity;
  },
});

select.init();
save.init();
</script>
