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
        :disabled="disabled"
      >
        <v-icon color="grey">
          mdi-pencil
        </v-icon>
      </v-btn>
    </template>

    <v-card class="px-5 py-3">
      <div class="headline font-weight-light">
        Select {{ taxon.replace('_', ' ') }}
      </div>
      <v-card-text>
        <v-autocomplete
          v-model="selectedItems"
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
    </v-card>
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

      disabled: {
        type: Boolean,
        default: false,
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
          this.hasUnknown = initialItems.length && initialItems[0].id === -1
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
        const { data } = await this.$http.get(`autocomplete/?project=catalogue&type=${this.taxon}&term=${search}`)
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
