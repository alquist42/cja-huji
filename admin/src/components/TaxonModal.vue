<template>
  <v-dialog v-model="dialog">
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
      }
    },

    watch: {
      value: {
        immediate: true,
        handler (initialItems) {
          this.items = initialItems.slice(0)
          this.selectedItems = initialItems.slice(0)
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
        this.items = data || []
      },

      closeDialog () {
        this.dialog = false
      },

      save () {
        this.$emit('input', this.selectedItems)
        this.closeDialog()
      },
    },
  }
</script>
