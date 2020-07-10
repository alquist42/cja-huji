<template>
  <v-card
    class="ma-3"
    flat
  >
    <v-card-title class="headline mb-5">Edit Metadata</v-card-title>

    <v-card-text class="pb-0">
      <v-autocomplete
        v-model="photographer_id"
        :items="photographers"
        :search-input.sync="searchPhotographer"
        item-value="id"
        item-text="name"
        label="Photographer"
        placeholder="Start typing to search"
        outlined
        :loading="isLoadingPhotographer"
      />
      <v-autocomplete
        v-model="copyright_id"
        :items="copyrights"
        :search-input.sync="searchCopyright"
        item-value="id"
        item-text="name"
        label="Copyright"
        placeholder="Start typing to search"
        outlined
        :loading="isLoadingCopyright"
      />
      <v-text-field
        v-model="date"
        label="Date"
        outlined
        counter="20"
        placeholder="Specify date in any format"
      />
    </v-card-text>

    <v-card-actions class="pt-0">
      <v-btn
        outlined
        color="warning"
        @click="closeEditor"
      >
        Cancel
      </v-btn>
      <v-btn
        outlined
        color="success"
        :loading="isSaving"
        :disabled="isSaving"
        @click="save"
      >
        Save
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  export default {
    name: 'MetadataEditor',

    props: {
      files: {
        type: Array,
        required: true,
      },
    },

    data: () => ({
      isSaving: false,

      photographer_id: null,
      photographers: [],
      searchPhotographer: null,
      isLoadingPhotographer: false,

      copyright_id: null,
      copyrights: [],
      searchCopyright: null,
      isLoadingCopyright: false,

      date: '',
    }),

    watch: {
      async searchPhotographer (val) {
        if (this.isLoadingPhotographer) return

        this.isLoadingPhotographer = true
        try {
          const response = await this.$http.get(`/api/photographers?project=catalogue&search=${val}`)
          this.photographers = response.data
        } catch (e) {
          console.log(e)
        } finally {
          this.isLoadingPhotographer = false
        }
      },

      async searchCopyright (val) {
        if (this.isLoadingCopyright) return

        this.isLoadingCopyright = true
        try {
          const response = await this.$http.get(`/api/copyrights?project=catalogue&search=${val}`)
          this.copyrights = response.data
        } catch (e) {
          console.log(e)
        } finally {
          this.isLoadingCopyright = false
        }
      },
    },

    methods: {

      closeEditor () {
        this.$emit('close')
      },

      save () {
        this.closeEditor()
      },
    },
  }
</script>
