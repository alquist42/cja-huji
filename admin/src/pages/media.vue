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
        <slot name="media-manager" />
      </v-container>

      <!--      <dashboard-core-footer />-->
    </v-main>

    <!--    <dashboard-core-settings />-->
  </v-app>
</template>

<script>
  /* global EventHub */

  export default {
    name: 'Media',

    components: {
      DashboardCoreAppBar: () => import('../views/dashboard/components/core/AppBar'),
      DashboardCoreDrawer: () => import('../views/dashboard/components/core/Drawer'),
      // DashboardCoreSettings: () => import('./components/core/Settings'),
      // DashboardCoreView: () => import('../components/core/View'),
    },

    data: () => ({
      snackbar: false,
      snackbarText: '',
      snackbarColor: '',
    }),

    created () {
      EventHub.listen('show-snackbar', (options) => this.showSnackbar(options.color, options.text))
      EventHub.listen('MediaManager-create-new-item', (images) => this.createItemFromImages(images))
    },

    beforeDestroy () {
      EventHub.removeListenersFrom([
        'show-snackbar',
        'MediaManager-create-new-item',
      ])
    },

    methods: {
      showSnackbar (color, text) {
        // TODO: after switching to a real SPA move this into the header component
        this.snackbarColor = color
        this.snackbarText = text
        this.snackbar = true
      },

      showSnackbarSuccess (text) {
        // TODO: after switching to a real SPA move this into the header component
        this.showSnackbar('success', text)
      },

      showSnackbarError (text = 'An error occurred') {
        // TODO: after switching to a real SPA move this into the header component
        this.showSnackbar('error', text)
      },

      async createItemFromImages (images) {
        try {
          const { data } = await this.$http.post('/api/items?project=catalogue', {
            images: images,
          })

          window.location.href = `/staff/items/${data.id}`
        } catch (e) {
          this.showSnackbarError()
        }
      },
    },
  }
</script>
