<template>
  <v-dialog
    :value="value"
    @input="$emit('input', $event)"
    max-width="800"
  >
    <v-card class="px-5 py-3">
      <div class="headline font-weight-light">
        {{ title }}
      </div>
      <v-card-text>
        <v-autocomplete
          v-model="selectedItem"
          autofocus
          outlined
          clearable
          placeholder="Start typing to search"
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
          Copy
        </v-btn>
      </v-card-actions>
    </v-card>
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
        items: [],
        selectedItem: null,
        isLoading: false,
        searchInput: '',
        searchTimeoutId: null,
      }
    },

    watch: {
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
        this.$emit('input', false)
      },

      save () {
        this.$emit('selected', this.selectedItem)
      },
    },
  }
</script>
