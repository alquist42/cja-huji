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
      /* eslint-disable */
      EventHub.listen('open-media-manager-modal', () => this.openModal())

      EventHub.listen('create-item', (data) => {
        console.log('create-item Event', data)
      })
      /* eslint-enable */
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
