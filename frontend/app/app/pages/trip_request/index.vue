<template>
  <nuxt-layout name="app">
    <q-form-actions
      :actions="[
        {
          label: 'Novo',
          to: '/trip_request/new',
          color: 'primary',
        },
      ]"
    />
    <br />

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
        {
          name: 'status',
          label: 'Status',
          align: 'left',
          width: '100px',
        },
        { name: 'dates', label: 'Datas', align: 'left', width: '100px' },
        { name: 'actions', label: '', width: 0 },
      ]"
    >
      <template #body-cell-status="props">
        <q-td :props="props">
          <q-chip
            v-if="props.row.status == 'pending'"
            color="warning"
          >
            Pendente
          </q-chip>
          <q-chip
            v-if="props.row.status == 'approved'"
            color="positive"
          >
            Aprovado
          </q-chip>
          <q-chip
            v-if="props.row.status == 'rejected'"
            color="negative"
          >
            Rejeitado
          </q-chip>
        </q-td>
      </template>
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
            :actions="[
              {
                icon: 'edit',
                to: `/trip_request/${props.row.id}`,
              },
              {
                icon: 'check',
                loading: approve.busy,
                onClick() {
                  approve.approve(props.row);
                },
                showIf() {
                  if (app.user.role != 'admin') return false;
                  if (props.row.status != 'pending') return false;
                  return true;
                },
              },
              {
                icon: 'block',
                loading: approve.busy,
                onClick() {
                  approve.reject(props.row);
                },
                showIf() {
                  if (app.user.role != 'admin') return false;
                  if (props.row.status != 'pending') return false;
                  return true;
                },
              },
            ]"
          />
        </q-td>
      </template>
    </q-table>
  </nuxt-layout>
</template>

<script setup>
const f = useFormat();
const app = useApp();

const search = useAxios({
  method: "get",
  url: "/api/trip_request",
  response: { data: [] },
});

const approve = useAxios({
  method: "post",
  url: "/api/trip_request/:id/approve",
  async approve(item) {
    approve.url = `/api/trip_request/${item.id}/approve`;
    await approve.submit();
    await search.submit();
  },
  async reject(item) {
    approve.url = `/api/trip_request/${item.id}/reject`;
    await approve.submit();
    await search.submit();
  },
});

search.submit();
</script>
