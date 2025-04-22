<template>
  <div class="iframe-wrapper">
    <iframe src="${baseURL}/admin/dashboard" class="full-screen"></iframe>
  </div>
</template>

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
