<template>
  <v-navigation-drawer
    v-model="metadataDrawer"
    fixed
    right
    temporary
    width="500"
    class="metadata-editor-drawer"
  >
    <metadata-editor
      v-if="metadataDrawer"
      :selected-file="selectedFile"
      :selected-files="selectedFiles"
      @close="metadataDrawer = false"
    />
  </v-navigation-drawer>
</template>

<script>
  /* global EventHub */

  export default {
    name: 'MetadataEditorDrawer',

    components: {
      MetadataEditor: () => import('./MetadataEditor'),
    },

    data: () => ({
      metadataDrawer: false,
      selectedFile: {},
      selectedFiles: [],
    }),

    watch: {
      metadataDrawer (val) {
        EventHub.fire('disable-global-keys', val)
      },
    },

    created () {
      EventHub.listen('MediaManager-open-metadata-editor', (payload) => {
        this.metadataDrawer = true
        this.selectedFile = payload.selectedFile
        this.selectedFiles = payload.selectedFiles
      })
    },

    beforeDestroy () {
      EventHub.removeListenersFrom('MediaManager-open-metadata-editor')
    },
  }
</script>

<style type="text/css">
  .metadata-editor-drawer {
    z-index: 41;
  }
</style>
