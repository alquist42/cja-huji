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
          // eslint-disable-next-line
          let payload = {
            images: images,
          }
          if (this.id) {
            payload.item = {
              parent_id: this.id,
            }
          }

          const { data } = await this.$http.post('/api/items?project=catalogue', payload)

          window.location.href = `/staff/items/${data.id}`
        } catch (e) {
          this.showSnackbarError()
        }
      },
    },
  }
</script>
