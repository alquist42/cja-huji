<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <div class="display-2 font-weight-light">
        Base Fields
      </div>
    </template>
    <v-card-text>
      <v-combobox
        :value="value.creation_date"
        :items="dates"
        :disabled="disabled"
        :search-input.sync="searchDate"
        item-value="id"
        item-text="name"
        label="Creation date"
        placeholder="Start typing to search"
        outlined
        :loading="isLoadingDates"
        @input="update('creation_date', $event)"
      />
      <v-combobox
        :value="value.reconstruction_dates_object"
        :items="reconstructionDates"
        :disabled="disabled"
        :search-input.sync="searchReconstructionDates"
        item-value="id"
        item-text="name"
        label="Reconstruction dates"
        placeholder="Start typing to search"
        outlined
        :loading="isLoadingReconstructionDates"
        @input="update('reconstruction_dates_object', $event)"
      />
      <v-combobox
        :value="value.activity_dates_object"
        :items="activityDates"
        :disabled="disabled"
        :search-input.sync="searchActivityDates"
        item-value="id"
        item-text="name"
        label="Activity dates"
        placeholder="Start typing to search"
        outlined
        :loading="isLoadingActivityDates"
        @input="update('activity_dates_object', $event)"
      />
      <v-combobox
        :value="value.copyright"
        :items="copyrights"
        :disabled="disabled"
        :search-input.sync="searchCopyright"
        item-value="id"
        item-text="name"
        label="Copyright"
        placeholder="Start typing to search"
        outlined
        :loading="isLoadingCopyright"
        @input="update('copyright', $event)"
      />
      <v-textarea
        :value="value.remarks"
        :disabled="disabled"
        label="Remarks"
        outlined
        counter="200"
        no-resize
        @input="update('remarks', $event)"
      />
      <v-switch
        :value="value.artifact_at_risk"
        :disabled="disabled"
        label="Artifact at risk"
        inset
        @change="update('artifact_at_risk', $event)"
      />
    </v-card-text>
  </base-material-card>
</template>

<script>
  export default {
    name: 'ItemBaseFields',

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
      dates: [],
      searchDate: null,
      isLoadingDates: false,
      reconstructionDates: [],
      searchReconstructionDates: null,
      isLoadingReconstructionDates: false,
      activityDates: [],
      searchActivityDates: null,
      isLoadingActivityDates: false,
      copyrights: [],
      searchCopyright: null,
      isLoadingCopyright: false,
    }),

    watch: {
      async searchDate (val) {
        if (this.isLoadingDates) return

        this.isLoadingDates = true
        try {
          const { data } = await this.$http.get(`dates?project=catalogue&search=${val}`)
          this.dates = data
        } catch (e) {
          console.log(e)
        } finally {
          this.isLoadingDates = false
        }
      },

      async searchReconstructionDates (val) {
        if (this.isLoadingReconstructionDates) return

        this.isLoadingReconstructionDates = true
        try {
          const { data } = await this.$http.get(`dates?project=catalogue&search=${val}`)
          this.reconstructionDates = data
        } catch (e) {
          console.log(e)
        } finally {
          this.isLoadingReconstructionDates = false
        }
      },

      async searchActivityDates (val) {
        if (this.isLoadingActivityDates) return

        this.isLoadingActivityDates = true
        try {
          const { data } = await this.$http.get(`dates?project=catalogue&search=${val}`)
          this.activityDates = data
        } catch (e) {
          console.log(e)
        } finally {
          this.isLoadingActivityDates = false
        }
      },

      async searchCopyright (val) {
        if (this.isLoadingCopyright) return

        this.isLoadingCopyright = true
        try {
          const { data } = await this.$http.get(`copyrights?project=catalogue&search=${val}`)
          this.copyrights = data
        } catch (e) {
          console.log(e)
        } finally {
          this.isLoadingCopyright = false
        }
      },
    },

    methods: {
      update (key, value) {
        this.$emit('input', { ...this.value, [key]: value })
      },
    },
  }
</script>
