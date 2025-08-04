<template>
  <nuxt-layout name="app">
    <q-table
      :pagination="{
        page: search.params.page,
        rowsPerPage: search.params.per_page,
        sortBy: null,
        descending: false,
        rowsNumber: 0,
      }"
      @request="
        (props) => {
          search.params.page = props.pagination.page;
          search.params.per_page = props.pagination.rowsPerPage;
          search.submit();
          console.log(props);
        }
      "
      :loading="search.busy"
      :rows="search.response.data"
      :columns="[
        { field: 'name', label: 'Requisitante', align: 'left' },
        {
          field: 'destination',
          label: 'Destino',
          align: 'left',
          width: '100px',
        },
        { name: 'dates', label: 'Datas', align: 'left', width: '100px' },
        { name: 'actions', label: '', width: 0 },
      ]"
    >
      <template #body-cell-dates="props">
        <q-td :props="props">
          <div v-if="props.row.departure_date">
            Partida: {{ f.date(props.row.departure_date) }}
          </div>
          <div v-if="props.row.return_date">
            Retorno: {{ f.date(props.row.return_date) }}
          </div>
        </q-td>
      </template>
      <template #body-cell-actions="props">
        <q-td :props="props">
          <q-table-actions
            :actions="[{ icon: 'edit', to: `/trip_request/${props.row.id}` }]"
          />
        </q-td>
      </template>
    </q-table>

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
          icon="add"
          to="/trip_request/new"
        />
      </q-fab>
    </q-page-sticky>
  </nuxt-layout>
</template>

<script setup>
const f = useFormat();

const search = useAxios({
  method: "get",
  url: "/api/trip_request",
  response: { data: [] },
});

search.submit();
</script>
