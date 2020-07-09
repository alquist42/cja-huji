<script>
  /* global EventHub */

  export default {
    created () {
      EventHub.listen('MediaManager-create-new-item', (images) => this.createItemFromImages(images))
    },

    beforeDestroy () {
      EventHub.removeListenersFrom('MediaManager-create-new-item')
    },

    methods: {
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
