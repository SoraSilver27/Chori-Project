<template>
  <v-app>
    <v-main>
      <Menu/>
      <router-view />
    </v-main>
  </v-app>
</template>

<script setup>
  import Menu from '@/components/Menu.vue'
</script>
