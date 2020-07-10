<script>
  /* global EventHub */

  export default {
    data: () => ({
      snackbar: false,
      snackbarText: '',
      snackbarColor: '',
    }),

    created () {
      EventHub.listen('show-snackbar', (options) => this.showSnackbar(options.color, options.text))
    },

    beforeDestroy () {
      EventHub.removeListenersFrom('show-snackbar')
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
    },
  }
</script>
