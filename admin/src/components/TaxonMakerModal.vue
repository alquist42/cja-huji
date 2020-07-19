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
        <v-icon color="grey">mdi-plus-thick</v-icon>
      </v-btn>
    </template>

    <base-material-card class="px-5 py-3">
      <template v-slot:heading>
        <div class="display-2 font-weight-light">
          Add maker
        </div>
      </template>
      <v-card-text>
        <v-autocomplete
          autofocus
          outlined
          clearable
          cache-items
          label="Artist"
          placeholder="Start typing to search"
          return-object
          :search-input.sync="searchInput.artist"
          item-text="name"
          item-value="id"
          :items="items.artists"
          :loading="isLoading.artists"
          v-model="maker.artist"
        />
        <v-autocomplete
          outlined
          clearable
          cache-items
          label="Profession"
          placeholder="Start typing to search"
          return-object
          :search-input.sync="searchInput.profession"
          item-text="name"
          item-value="id"
          :items="items.professions"
          :loading="isLoading.professions"
          v-model="maker.profession"
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
          :disabled="!maker.artist || !maker.profession"
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
    name: 'TaxonMakerModal',

    data () {
      return {
        dialog: false,
        maker: {
          artist: null,
          profession: null,
        },
        items: {
          artists: [],
          professions: [],
        },
        isLoading: {},
        searchInput: {},
        searchTimeoutIds: {},
      }
    },

    watch: {
      'searchInput.artist' (search) {
        clearTimeout(this.searchTimeoutIds.artist)
        this.searchTimeoutIds.artist = setTimeout(() => this.autocomplete(search, 'artists'), 300)
      },

      'searchInput.profession' (search) {
        clearTimeout(this.searchTimeoutIds.profession)
        this.searchTimeoutIds.profession = setTimeout(() => this.autocomplete(search, 'professions'), 300)
      },
    },

    methods: {
      async autocomplete (search, type) {
        if (!search || search.length < 2) {
          return
        }

        this.isLoading.artist = true
        const { data } = await this.$http.get(`autocomplete/?project=catalogue&type=${type}&term=${search}`)
        this.isLoading.artist = false
        this.items[type] = data || []
      },

      closeDialog () {
        this.dialog = false
      },

      save () {
        this.$emit('input', { ...this.maker })
        this.maker = {
          artist: null,
          profession: null,
        }
        this.closeDialog()
      },
    },
  }
</script>
