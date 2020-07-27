<template>
  <v-container
    fluid
    tag="section"
  >
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
      @cancel="cancelCreatingItemFromImages"
      @no="createItemWithoutDetachingImages"
      @yes="createItemDetachingImages"
    />

    <dashboard-core-app-bar :loading="isLoading" />

    <div id="media-wrapper" />

    <metadata-editor-drawer />
  </v-container>
</template>

<script>
  /* global EventHub */
  import CreateItemFromImages from '../mixins/CreateItemFromImages'
  import SnackBar from '../mixins/SnackBar'

  export default {
    name: 'Media',

    components: {
      DashboardCoreAppBar: () => import('./dashboard/components/core/AppBar'),
      MetadataEditorDrawer: () => import('../components/MetadataEditorDrawer'),
      ConfirmationModal: () => import('../components/ConfirmationModal'),
    },

    mixins: [CreateItemFromImages, SnackBar],

    data: () => ({
      isLoading: false,
    }),

    created () {
      EventHub.fire('show-media-manager')
    },

    beforeDestroy () {
      EventHub.fire('hide-media-manager')
    },
  }
</script>
