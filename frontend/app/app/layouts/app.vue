<template>
  <q-layout view="lHr lpR lFr">
    <q-header class="bg-primary text-white">
      <q-toolbar>
        <q-btn
          dense
          flat
          round
          icon="menu"
          @click="drawerLeft.toggle()"
        />

        <q-toolbar-title>
          <q-avatar>
            <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg" />
          </q-avatar>
          Title
        </q-toolbar-title>

        <!-- <q-btn
          dense
          flat
          round
          icon="menu"
          @click="drawerRight.toggle()"
        /> -->
      </q-toolbar>
    </q-header>

    <q-drawer
      show-if-above
      v-model="drawerLeft.show"
      side="left"
    >
      <q-list>
        <template v-for="o in drawerLeft.navItems">
          <q-item
            clickable
            v-bind="o.linkBind"
            tag="a"
          >
            <q-item-section
              v-if="o.icon"
              avatar
            >
              <q-icon :name="o.icon" />
            </q-item-section>

            <q-item-section>
              <q-item-label>{{ o.title }}</q-item-label>
              <q-item-label caption>
                {{ o.caption }}
              </q-item-label>
            </q-item-section>
          </q-item>
        </template>
      </q-list>
    </q-drawer>

    <q-drawer
      v-model="drawerRight.show"
      side="right"
      behavior="mobile"
    >
      <!-- drawer content -->
    </q-drawer>

    <q-page-container>
      <slot />
    </q-page-container>
  </q-layout>
</template>

<script setup>
const drawerLeft = reactive({
  show: true,
  toggle(value = null) {
    drawerLeft.show = value === null ? !drawerLeft.show : value;
  },
  navItems: [
    {
      title: "Docs",
      caption: "quasar.dev",
      icon: "school",
      linkBind: {
        to: "/",
      },
    },
    {
      title: "Docs",
      caption: "quasar.dev",
      icon: "school",
      linkBind: {
        to: "?page=docs",
      },
    },

    {
      title: "Docs",
      caption: "quasar.dev",
      icon: "school",
      linkBind: {
        href: "https://quasar.dev",
        target: "_blank",
      },
    },
    {
      title: "Github",
      caption: "github.com/quasarframework",
      icon: "code",
      linkBind: {
        href: "https://github.com/quasarframework",
        target: "_blank",
      },
    },
    {
      title: "Discord Chat Channel",
      caption: "chat.quasar.dev",
      icon: "chat",
      linkBind: {
        href: "https://chat.quasar.dev",
        target: "_blank",
      },
    },
    {
      title: "Forum",
      caption: "forum.quasar.dev",
      icon: "record_voice_over",
      linkBind: {
        href: "https://forum.quasar.dev",
        target: "_blank",
      },
    },
    {
      title: "Twitter",
      caption: "@quasarframework",
      icon: "rss_feed",
      linkBind: {
        href: "https://twitter.quasar.dev",
        target: "_blank",
      },
    },
    {
      title: "Facebook",
      caption: "@QuasarFramework",
      icon: "public",
      linkBind: {
        href: "https://facebook.quasar.dev",
        target: "_blank",
      },
    },
    {
      title: "Quasar Awesome",
      caption: "Community Quasar projects",
      icon: "favorite",
      linkBind: {
        href: "https://awesome.quasar.dev",
        target: "_blank",
      },
    },
  ],
});

const drawerRight = reactive({
  show: false,
  toggle(value = null) {
    drawerRight.show = value === null ? !drawerRight.show : value;
  },
});
</script>
