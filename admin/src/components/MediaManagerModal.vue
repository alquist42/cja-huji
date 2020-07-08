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
      this.$eventBus.$on('open-media-manager-modal', this.openModal)
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
