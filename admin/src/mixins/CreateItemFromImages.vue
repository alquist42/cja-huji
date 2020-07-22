<script>
// TODO: think about moving this into a dedicated component with a confirmation modal instead of a mixin
  /* global EventHub */

  import NestedFiles from '../mixins/NestedFiles'

  export default {
    mixins: [NestedFiles],

    data: () => ({
      detachImagesConfirmationDialog: false,
      createFrom: {
        images: [],
        usedBy: [],
      },
    }),

    created () {
      EventHub.listen('MediaManager-create-new-item', this.handleEvent)
    },

    beforeDestroy () {
      EventHub.removeListenersFrom('MediaManager-create-new-item')
    },

    methods: {
      async handleEvent (filesAndFolders) {
        this.createFrom.images = await this.getAllNestedFiles(filesAndFolders)
        this.createFrom.usedBy = this.getUsage(this.createFrom.images)

        if (!this.createFrom.usedBy.length) {
          return this.createItemFromImages()
        }

        if (this.createFrom.usedBy.length === 1 && this.item && this.createFrom.usedBy[0] === this.item.id) {
          return this.createItemFromImages(this.createFrom.usedBy)
        }

        this.detachImagesConfirmationDialog = true
      },

      getUsage (images) {
        const usedBy = []

        images.forEach(image => {
          image.image.items.forEach(({ id }) => {
            if (!usedBy.includes(id)) {
              usedBy.push(id)
            }
          })
        })

        return usedBy
      },

      createItemWithoutDetachingImages () {
        this.detachImagesConfirmationDialog = false
        this.createItemFromImages(this.item ? [this.item.id] : [])
      },

      createItemDetachingImages () {
        this.detachImagesConfirmationDialog = false
        this.createItemFromImages(this.createFrom.usedBy)
      },

      async createItemFromImages (detachFrom = []) {
        const payload = {
          item: {
            parent_id: this.id || null,
          },
          images: this.createFrom.images,
          detach_from: detachFrom,
        }

        try {
          this.isLoading = true
          const { data } = await this.$http.post('items?project=catalogue', payload)
          this.$router.push({ name: 'Item', params: { id: data.id } })
        } catch (e) {
          this.showSnackbarError()
        }
      },
    },
  }
</script>
