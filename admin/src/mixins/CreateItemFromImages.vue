<script>
  /* global EventHub */

  import NestedFiles from '../mixins/NestedFiles'

  export default {
    mixins: [NestedFiles],

    created () {
      EventHub.listen('MediaManager-create-new-item', (images) => this.createItemFromImages(images))
    },

    beforeDestroy () {
      EventHub.removeListenersFrom('MediaManager-create-new-item')
    },

    methods: {
      async createItemFromImages (filesAndFolders) {
        const images = await this.getAllNestedFiles(filesAndFolders)

        if (this.id) {
          return this.createChild(images)
        }

        const payload = {
          item: {
            parent_id: null,
          },
          images,
        }

        try {
          const { data } = await this.$http.post('/api/items?project=catalogue', payload)

          window.location.href = `/staff/items/${data.id}`
        } catch (e) {
          this.showSnackbarError()
        }
      },
    },
  }
</script>
