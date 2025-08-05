import { defineStore } from "pinia";

export default () => {
  let loadInterval;
  const app = defineStore("useApp", () => {
    return reactive({
      ready: false,

      load: useAxios({
        method: "get",
        url: "/api/app/load",
        onSuccess() {
          app.user = app.load.response.user || null;
          app.notifications = app.load.response.notifications || null;
        },
      }),

      user: null,
      notifications: [],

      logout: useAxios({
        method: "post",
        url: "/api/auth/logout",
        async onSuccess() {
          await app.setToken("", false);
          location.href = `/auth?redirect=${app.route.fullPath}`;
        },
      }),

      async setToken(token, init = true) {
        localStorage.setItem("access_token", token);
        if (init) await app.init();
      },

      getToken() {
        return localStorage.getItem("access_token") || "";
      },

      async authVerify() {
        if (app.route.path.startsWith("/auth")) return;
        if (!app.user) app.router.push("/auth");
      },

      route: useRoute(),
      router: useRouter(),

      async init() {
        await app.load.submit();
        app.ready = true;
        await app.authVerify();
        if (loadInterval) clearInterval(loadInterval);
        setInterval(app.init, 15 * 1000);
      },
    });
  })();

  return app;
};
