export default defineNuxtRouteMiddleware((to) => {
  if (process.client) {
    // Redirect Nuxt routes to Laravel inside an iframe
    window.location.href = `http://127.0.0.1:8000${to.fullPath}`;
  }
});
