<template>
  <div
    style="
      display: flex;
      background: url(https://picsum.photos/1500/1500) center center no-repeat;
      background-size: cover;
      height: 100vh;
    "
  >
    <div
      class="mobile-hide"
      style="flex-grow: 1"
    ></div>
    <div
      style="
        width: 500px;
        max-width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      "
    >
      <slot />
    </div>
  </div>
</template>
