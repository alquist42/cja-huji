<script>
  /* global EventHub */

  import MediaManagerModalMixin from '../../../resources/assets/vendor/MediaManager/js/mixins/modal'

  export default {
    name: 'MediaManagerModal',

    mixins: [MediaManagerModalMixin],

    props: {
      itemId: {
        type: Number,
        required: true,
      },
    },

    data () {
      return {
        images: '',
      }
    },

    created () {
      EventHub.listen('MediaManagerModal-show', () => this.toggleModalFor('images'))
      EventHub.listen('MediaManagerModal-modal-creating-child', () => this.hideInputModal())

      EventHub.listen('MediaManagerModal-create-new-item', (data) => {
        console.log('MediaManagerModal-create-new-item Event', data)
      })
    },

    beforeDestroy () {
      EventHub.removeListenersFrom([
        'MediaManagerModal-show',
        'MediaManagerModal-modal-created-child',
        'MediaManagerModal-create-new-item',
      ])
    },
  }
</script>
