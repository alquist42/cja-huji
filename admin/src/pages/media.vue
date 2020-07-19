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

    <confirmation-modal
      :value="detachImagesConfirmationDialog"
      title="Detach images"
      message="Images are attached to other items. Detach from them?"
      btn-cancel-text="No"
      btn-confirm-text="Yes"
      @cancel="createItemWithoutDetachingImages"
      @confirm="createItemDetachingImages"
    />

    <dashboard-core-app-bar />

    <dashboard-core-drawer />

    <v-main>
      <v-container
        id="user-profile"
        fluid
        tag="section"
      >
        <metadata-editor-drawer />

        <slot name="media-manager" />
      </v-container>

      <!--      <dashboard-core-footer />-->
    </v-main>

    <!--    <dashboard-core-settings />-->
  </v-app>
</template>

<script>
  import CreateItemFromImages from '../mixins/CreateItemFromImages'
  import SnackBar from '../mixins/SnackBar'

  export default {
    name: 'Media',

    components: {
      DashboardCoreAppBar: () => import('../views/dashboard/components/core/AppBar'),
      DashboardCoreDrawer: () => import('../views/dashboard/components/core/Drawer'),
      // DashboardCoreSettings: () => import('./components/core/Settings'),
      // DashboardCoreView: () => import('../components/core/View'),
      MetadataEditorDrawer: () => import('../components/MetadataEditorDrawer'),
      ConfirmationModal: () => import('../components/ConfirmationModal'),
    },

    mixins: [CreateItemFromImages, SnackBar],
  }
</script>
