<template>
  <v-app>
    <v-snackbar
      v-model="snackbar"
      :color="snackbarColor"
      top
    >
      {{ snackbarText }}
      <template v-slot:action="{ attrs }">
        <v-btn
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>

    <dashboard-core-app-bar />

    <dashboard-core-drawer />

    <v-main>
      <v-container
        id="user-profile"
        fluid
        tag="section"
      >
        <v-navigation-drawer
          v-model="metadataDrawer"
          fixed
          right
          temporary
          width="500"
        >
          <metadata-editor
            :files="selectedFiles"
            @close="metadataDrawer = false"
          />
        </v-navigation-drawer>

        <slot name="media-manager" />
      </v-container>

      <!--      <dashboard-core-footer />-->
    </v-main>

    <!--    <dashboard-core-settings />-->
  </v-app>
</template>

<script>
  /* global EventHub */

  import CreateItemFromImages from '../mixins/CreateItemFromImages'
  import SnackBar from '../mixins/SnackBar'

  export default {
    name: 'Media',

    components: {
      DashboardCoreAppBar: () => import('../views/dashboard/components/core/AppBar'),
      DashboardCoreDrawer: () => import('../views/dashboard/components/core/Drawer'),
      // DashboardCoreSettings: () => import('./components/core/Settings'),
      // DashboardCoreView: () => import('../components/core/View'),
      MetadataEditor: () => import('../components/MetadataEditor'),
    },

    mixins: [CreateItemFromImages, SnackBar],

    data: () => ({
      metadataDrawer: false,
      selectedFiles: [],
    }),

    watch: {
      metadataDrawer (val) {
        EventHub.fire('disable-global-keys', val)
      },
    },

    created () {
      EventHub.listen('MediaManager-open-metadata-editor', (selectedFiles) => {
        this.metadataDrawer = true
        this.selectedFiles = selectedFiles
      })
    },

    beforeDestroy () {
      EventHub.removeListenersFrom('MediaManager-open-metadata-editor')
    },
  }
</script>
