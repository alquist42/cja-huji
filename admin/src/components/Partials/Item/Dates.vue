<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <div class="display-2 font-weight-light">
        Dates
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
    },

    methods: {
      update (key, value) {
        this.$emit('input', { ...this.value, [key]: value })
      },
    },
  }
</script>
