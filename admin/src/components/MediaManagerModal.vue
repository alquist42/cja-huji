<script>
  /* global EventHub */

  import MediaManagerModalMixin from '../../../resources/assets/vendor/MediaManager/js/mixins/modal'

  export default {
    name: 'MediaManagerModal',

    mixins: [MediaManagerModalMixin],

    props: {
      itemId: {
        type: String,
        required: true,
      },
    },

    data () {
      return {
        images: '',
      }
    },

    created () {
      EventHub.listen('MediaManagerModal-show', this.openModal)

      EventHub.listen('MediaManagerModal-create-new-item', (data) => {
        console.log('MediaManagerModal-create-new-item Event', data)
      })

      EventHub.listen('MediaManagerModal-include-images-in-item', (selectedImages) => {
        this.includeImagesInItem(selectedImages)
      })
    },

    beforeDestroy () {
      EventHub.removeListenersFrom([
        'MediaManagerModal-show',
        'MediaManagerModal-create-new-item',
        'MediaManagerModal-include-images-in-item',
      ])
    },

    methods: {
      openModal () {
        this.toggleModalFor('images')
      },

      async includeImagesInItem (images) {
        try {
          const { data } = await this.$http.post('/api/item_images?project=catalogue', {
            itemId: this.itemId,
            images: images,
          })

          EventHub.fire('MediaManagerModal-images-were-included', data)
        } catch (e) {
          EventHub.fire('show-snackbar', {
            color: 'error',
            text: 'An error occurred',
          })
        }
      },
    },
  }
</script>
