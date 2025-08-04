<template>
  <nuxt-layout name="app">
    <q-form @submit.prevent="save.submit()">
      <q-input
        v-model="save.data.name"
        label="Nome do solicitante"
        :error-message="save.fieldError('name')"
        :error="!!save.fieldError('name')"
        :disable="!!save.data.id"
      />
      <q-input
        v-model="save.data.destination"
        label="Destino"
        :error-message="save.fieldError('destination')"
        :error="!!save.fieldError('destination')"
        :disable="!!save.data.id"
      />

      <q-input
        :model-value="f.date(save.data.departure_date)"
        label="Data de partida"
        readonly
        :error-message="save.fieldError('departure_date')"
        :error="!!save.fieldError('departure_date')"
        :disable="!!save.data.id"
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
        :disable="!!save.data.id"
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

      <q-form-actions
        :actions="[
          {
            label: 'Salvar',
            showIf() {
              return app.user && !app.user.id;
            },
          },
          {
            label: 'Voltar',
            to: '/trip_request',
          },
        ]"
      />
    </q-form>
  </nuxt-layout>
</template>

<script setup>
const f = useFormat();
const route = useRoute();
const router = useRouter();
const app = useApp();

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
