<template>
  <v-dialog
    v-model="dialog"
    max-width="800"
  >
    <template #activator="{ on, attrs }">
      <v-btn
        icon
        v-bind="attrs"
        v-on="on"
      >
        <v-icon color="grey">mdi-pencil</v-icon>
      </v-btn>
    </template>

    <base-material-card class="px-5 py-3">
      <template v-slot:heading>
        <div class="display-2 font-weight-light">
          Select {{ taxon.replace('_', ' ') }}
        </div>
      </template>
      <v-card-text>
        <v-autocomplete
          autofocus
          outlined
          clearable
          multiple
          chips
          cache-items
          deletable-chips
          placeholder="Start typing to search"
          return-object
          :search-input.sync="searchInput"
          item-text="name"
          item-value="id"
          :items="items"
          :loading="isLoading"
          v-model="selectedItems"
        />
      </v-card-text>
      <v-card-actions>
        <v-btn
          text
          color="warning"
          @click="closeDialog"
        >
          Cancel
        </v-btn>
        <v-btn
          text
          color="primary"
          @click="save"
        >
          Ok
        </v-btn>
      </v-card-actions>
    </base-material-card>
  </v-dialog>
</template>

<script>
  export default {
    name: 'TaxonModal',

    props: {
      taxon: {
        type: String,
        required: true,
      },

      value: {
        type: Array,
        required: true,
      },
    },

    data () {
      return {
        dialog: false,
        items: [],
        selectedItems: [],
        isLoading: false,
        searchInput: '',
        searchTimeoutId: null,
        hasUnknown: false,
      }
    },

    watch: {
      value: {
        immediate: true,
        handler (initialItems) {
          this.hasUnknown = initialItems[0].id === -1
          this.items = this.excludeUnknown(initialItems)
          this.selectedItems = this.items.slice(0)
        },
      },

      searchInput (search) {
        clearTimeout(this.searchTimeoutId)
        this.searchTimeoutId = setTimeout(() => this.autocomplete(search), 300)
      },
    },

    methods: {
      async autocomplete (search) {
        if (!search || search.length < 2) {
          return
        }

        this.isLoading = true
        const { data } = await this.$http.get(`/api/autocomplete/?project=catalogue&type=${this.taxon}&term=${search}`)
        this.isLoading = false
        this.items = this.excludeUnknown(data || [])
      },

      closeDialog () {
        this.dialog = false
      },

      save () {
        let items = this.selectedItems

        if (this.selectedItems.length === 0 && this.hasUnknown) {
          items = this.includeUnknown(items)
        }

        this.$emit('input', items)
        this.closeDialog()
      },

      excludeUnknown (arr) {
        return arr.filter(item => item.id > 0)
      },

      includeUnknown (arr) {
        return arr.concat([{ id: -1, name: 'unknown' }])
      },
    },
  }
</script>
