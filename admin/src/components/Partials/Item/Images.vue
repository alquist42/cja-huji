<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <v-row no-gutters>
        <v-col class="flex-grow-1 display-2 font-weight-light">
          Images: {{ value.images.length }}
        </v-col>
        <v-col
          cols="auto"
          class="d-flex align-center"
        >
          <v-btn
            icon
            :disabled="disabled || !value.id"
            @click="openMediaManagerModal"
          >
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
        </v-col>
      </v-row>
    </template>
    <v-card-text>
      <confirmation-modal
        :value="detachImagesConfirmationDialog"
        title="Detach images"
        message="Images are attached to other items. Detach from them?"
        @cancel="cancelOperation"
        @no="includeImagesWithoutDetaching"
        @yes="includeImagesWithDetaching"
      />

      <v-carousel height="250">
        <v-carousel-item
          v-for="image in value.images"
          :key="image.id"
        >
          <v-img
            :src="`/images/${value.id}-${image.id}-small.png`"
            max-height="250px"
            contain
          />
        </v-carousel-item>
      </v-carousel>
    </v-card-text>
  </base-material-card>
</template>

<script>
  /* global EventHub */

  import NestedFiles from '../../../mixins/NestedFiles'

  export default {
    name: 'ItemImages',

    components: {
      ConfirmationModal: () => import('../../../components/ConfirmationModal'),
    },

    mixins: [NestedFiles],

    props: {
      value: {
        type: Object,
        required: true,
      },

      disabled: {
        type: Boolean,
        default: false,
      },
    },

    data: () => ({
      detachImagesConfirmationDialog: false,
      createFrom: {
        images: [],
        usedBy: [],
      },
    }),

    created () {
      EventHub.listen('MediaManagerModal-include-images-in-item', this.handleEvent)
      EventHub.listen('MediaManagerModal-exclude-images-from-item', this.excludeImages)
      EventHub.listen('MediaManagerModal-files-deleted', this.updateImages)
      EventHub.listen('MediaManagerModal-files-uploaded', this.updateImages)
    },

    beforeDestroy () {
      EventHub.removeListenersFrom([
        'MediaManagerModal-include-images-in-item',
        'MediaManagerModal-exclude-images-from-item',
        'MediaManagerModal-files-deleted',
        'MediaManagerModal-files-uploaded',
      ])
    },

    methods: {
      openMediaManagerModal () {
        EventHub.fire('show-media-manager-dialog', this.value.id)
      },

      async handleEvent (filesAndFolders) {
        this.createFrom.images = await this.getAllNestedFiles(filesAndFolders)
        this.createFrom.usedBy = this.getUsage(this.createFrom.images)

        if (!this.createFrom.usedBy.length) {
          return this.includeImages()
        }

        this.detachImagesConfirmationDialog = true
      },

      getUsage (images) {
        const usedBy = []

        images.forEach(image => {
          image.image.items.forEach(({ id }) => {
            if (!usedBy.includes(id) && id !== this.value.id) {
              usedBy.push(id)
            }
          })
        })

        return usedBy
      },

      includeImagesWithoutDetaching () {
        this.detachImagesConfirmationDialog = false
        this.includeImages()
      },

      includeImagesWithDetaching () {
        this.detachImagesConfirmationDialog = false
        this.includeImages(this.createFrom.usedBy)
      },

      cancelOperation () {
        this.detachImagesConfirmationDialog = false
        EventHub.fire('MediaManagerModal-stop-loading')
      },

      async includeImages (detachFrom = []) {
        const images = [...this.value.images]

        this.createFrom.images.forEach(includingImage => {
          if (!this.value.images.find(img => img.id === includingImage.image.id)) {
            images.push(includingImage)
          }
        })

        try {
          const { data } = await this.$http.put(`items/${this.value.id}/images?project=catalogue`, {
            images,
            detach_from: detachFrom,
          })

          this.$emit('input', { ...this.value, images: data })
          this.$emit('success', 'Images have been included')
        } catch (e) {
          this.$emit('error')
        } finally {
          EventHub.fire('MediaManagerModal-stop-loading')
        }
      },

      async excludeImages (filesAndFolders) {
        const excludingImages = await this.getAllNestedFiles(filesAndFolders)
        const images = [...this.value.images]

        excludingImages.forEach(excludingImage => {
          const index = images.findIndex(img => img.id === excludingImage.image.id)

          if (index !== -1) {
            images.splice(index, 1)
          }
        })

        try {
          const { data } = await this.$http.put(`items/${this.value.id}/images?project=catalogue`, { images })

          this.$emit('input', { ...this.value, images: data })
          this.$emit('success', 'Images have been excluded')
          EventHub.fire('MediaManagerModal-stop-loading')
          EventHub.fire('MediaManagerModal-images-excluded-from-item')
        } catch (e) {
          this.$emit('error')
          EventHub.fire('MediaManagerModal-stop-loading')
        }
      },

      async updateImages () {
        try {
          const { data } = await this.$http.get(`items/${this.value.id}/images?project=catalogue`)

          this.$emit('input', { ...this.value, images: data })
        } catch (e) {
          console.error(e)
        }
      },
    },
  }
</script>
