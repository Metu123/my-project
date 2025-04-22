<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

// Redirect to the actual 404 page
router.replace('/404')
</script>

<template>
  <div />
</template>
