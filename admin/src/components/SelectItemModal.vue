<template>
  <v-dialog
    v-model="dialog"
    max-width="800"
  >
    <base-material-card class="px-5 py-3">
      <template v-slot:heading>
        <div class="display-2 font-weight-light">
          {{ title }}
        </div>
      </template>
      <v-card-text>
        <v-autocomplete
          autofocus
          outlined
          clearable
          placeholder="Start typing to search"
          :search-input.sync="searchInput"
          item-text="name"
          item-value="id"
          :items="items"
          :loading="isLoading"
          v-model="selectedItem"
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
          Copy
        </v-btn>
      </v-card-actions>
    </base-material-card>
  </v-dialog>
</template>

<script>
  export default {
    name: 'SelectItemModal',

    props: {
      exclude: {
        type: Number,
        default: null,
      },

      value: {
        type: Boolean,
        required: true,
      },

      title: {
        type: String,
        default: 'Select item',
      },
    },

    data () {
      return {
        dialog: false,
        items: [],
        selectedItem: null,
        isLoading: false,
        searchInput: '',
        searchTimeoutId: null,
      }
    },

    watch: {
      value: {
        immediate: true,
        handler (val) {
          this.dialog = val
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
        const { data } = await this.$http.get(`items/search/?project=catalogue&search=${search}`)
        this.isLoading = false
        this.items = data
      },

      closeDialog () {
        this.$emit('cancel')
      },

      save () {
        this.$emit('input', this.selectedItem)
      },
    },
  }
</script>
