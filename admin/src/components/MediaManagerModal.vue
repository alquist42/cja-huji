<script>
  import MediaManagerModalMixin from '../../../resources/assets/vendor/MediaManager/js/mixins/modal'

  export default {
    name: 'MediaManagerModal',

    mixins: [MediaManagerModalMixin],

    data () {
      return {
        images: '',
      }
    },

    created () {
      /* global EventHub */
      EventHub.listen('open-media-manager-modal', () => this.openModal())

      EventHub.listen('create-new-item', (data) => {
        console.log('create-new-item Event', data)
      })
    },

    beforeDestroy () {
      this.$eventBus.$off('open-media-manager-modal', this.openModal)
    },

    methods: {
      openModal () {
        this.toggleModalFor('images')
      },
    },
  }
</script>
