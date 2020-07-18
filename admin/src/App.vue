<template>
  <v-app>
    <dashboard-core-app-bar />
    <router-view />
  </v-app>
</template>

<script>
  export default {
    name: 'App',

    components: {
      DashboardCoreAppBar: () => import('@/views/dashboard/components/core/AppBar'),
    },
  }
</script>
