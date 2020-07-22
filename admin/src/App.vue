<template>
  <v-app>
    <dashboard-core-drawer />
    <v-main>
      <router-view />
      <!--      <dashboard-core-footer />-->
    </v-main>
    <!--<dashboard-core-settings />-->
  </v-app>
</template>

<script>
  export default {
    name: 'App',

    components: {
      DashboardCoreDrawer: () => import('./views/dashboard/components/core/Drawer'),
      // DashboardCoreFooter: () => import('./views/dashboard/components/core/Footer'),
      // DashboardCoreSettings: () => import('./views/dashboard/components/core/Settings'),
    },
  }
</script>
