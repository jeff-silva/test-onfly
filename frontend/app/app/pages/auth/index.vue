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
            type="password"
            autocomplete="new-password"
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
          <q-card-actions vertical>
            <q-btn
              class="text-white"
              @click="login.loginAs('main@grr.la')"
            >
              Logar como Administrador
            </q-btn>
            <q-btn
              class="text-white"
              @click="login.loginAs('user@grr.la')"
            >
              Logar como Usuário Comum
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
  data: { email: "", password: "" },
  async onSuccess() {
    await app.setToken(login.response.accessToken);
    location.href = route.query.redirect || "/";
  },
  loginAs(email) {
    login.data.email = email;
    login.data.password = email;
    login.submit();
  },
});
</script>
