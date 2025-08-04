<template>
  <nuxt-layout name="auth">
    <q-card>
      <q-card-section>
        <q-form @submit.prevent="login.submit()">
          <q-input
            v-model="login.data.email"
            label="E-mail"
          />
          <q-input
            v-model="login.data.password"
            label="Senha"
          />
          <q-separator dark />

          <q-card-actions align="right">
            <q-btn
              type="submit"
              :loading="login.busy"
            >
              Login
            </q-btn>
          </q-card-actions>
        </q-form>
      </q-card-section>
    </q-card>
  </nuxt-layout>
</template>

<script setup>
const app = useApp();
const route = useRoute();

const login = useAxios({
  method: "post",
  url: "/api/auth/login",
  data: { email: "main@grr.la", password: "main@grr.la" },
  async onSuccess() {
    await app.setToken(login.response.accessToken);
    location.href = route.query.redirect || "/";
  },
});
</script>
