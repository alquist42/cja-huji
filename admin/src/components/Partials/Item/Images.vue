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
      <v-carousel height="250">
        <v-carousel-item
          v-for="image in value.images"
          :key="image.id"
        >
          <v-img
            :lazy-src="`/storage/${image.small || image.medium || image.def || image.batch_url}`"
            :src="`http://cja.huji.ac.il/${image.small || image.medium || image.def || image.batch_url}`"
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

  export default {
    name: 'ItemImages',

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

    created () {
      EventHub.listen('MediaManagerModal-include-images-in-item', this.includeImages)
      EventHub.listen('MediaManagerModal-exclude-images-from-item', this.excludeImages)
      EventHub.listen('MediaManagerModal-files-deleted', this.updateImages)
    },

    beforeDestroy () {
      EventHub.removeListenersFrom([
        'MediaManagerModal-include-images-in-item',
        'MediaManagerModal-exclude-images-from-item',
        'MediaManagerModal-files-deleted',
      ])
    },

    methods: {
      openMediaManagerModal () {
        EventHub.fire('show-media-manager-dialog', this.value.id)
      },

      async includeImages (includingImages) {
        const images = this.value.images.slice(0)

        includingImages.forEach(includingImage => {
          if (!this.value.images.find(img => img.id === includingImage.image.id)) {
            images.push(includingImage)
          }
        })

        try {
          const { data } = await this.$http.put(`items/${this.value.id}/images?project=catalogue`, { images })

          this.$emit('input', { ...this.value, images: data })
          this.$emit('success', 'Images have been included')
        } catch (e) {
          this.$emit('error')
        }
      },

      async excludeImages (excludingImages) {
        const images = this.value.images.slice(0)

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
          EventHub.fire('MediaManagerModal-images-excluded-from-item')
        } catch (e) {
          this.$emit('error')
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
