<template>
  <div class="iframe-wrapper">
    <iframe :src="`${baseURL}/agent/${route.params.username}`" class="full-screen"></iframe>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';
const route = useRoute();
const { public: { baseURL } } = useRuntimeConfig();
</script>

<style scoped>
.iframe-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
}

.full-screen {
  width: 100%;
  height: 100%;
  border: none;
}
</style>
