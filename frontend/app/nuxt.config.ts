// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2025-07-15",
  devtools: { enabled: true },
  ssr: false,
  css: ["./app/app.scss"],
  modules: [
    ["@nuxt/icon", {}],
    ["@nuxt/scripts", {}],
    ["@pinia/nuxt", {}],
    [
      "nuxt-quasar-ui",
      {
        plugins: ["Notify"],
      },
    ],
  ],
});
