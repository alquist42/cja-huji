<template>
  <v-card
    class="ma-3"
    flat
  >
    <v-card-title class="headline mb-5">
      Edit Metadata
    </v-card-title>

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
      <v-text-field
        v-model="nli_picname"
        label="Scan"
        outlined
        counter="50"
      />
      <v-text-field
        v-model="negative"
        label="Negative"
        outlined
        counter="50"
      />
      <v-subheader>
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              v-bind="attrs"
              icon
              v-on="on"
              @click="togglePermissionsInheritance"
            >
              <v-icon color="grey">
                {{ permissionsInherited ? 'mdi-lock' : 'mdi-lock-open' }}
              </v-icon>
            </v-btn>
          </template>
          <span>{{ permissionsInherited ? 'Disable' : 'Enable' }} permissions inheritance</span>
        </v-tooltip>
        Permissions {{ permissionsInherited ? 'inherited' : '' }}
      </v-subheader>
      <template v-if="!permissionsInherited">
        <v-switch
          v-model="permissionSmall"
          label="Small"
        />
        <v-switch
          v-model="permissionMedium"
          label="Medium"
        />
        <v-switch
          v-model="permissionOriginal"
          label="Original"
        />
      </template>
    </v-card-text>

    <v-card-actions>
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
  /* global EventHub */

  import NestedFiles from '../mixins/NestedFiles'

  export default {
    name: 'MetadataEditor',

    mixins: [NestedFiles],

    props: {
      selectedFile: {
        type: Object,
        required: true,
      },
      selectedFiles: {
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
      nli_picname: '',
      negative: '',
      rights: '',
    }),

    computed: {
      permissionsInherited () {
        return !this.rights || this.rights === '2'
      },

      permissionSmall: {
        get () {
          if (this.rights.length < 3) return false

          return this.rights.substring(0, 1) === '1'
        },
        set (val) {
          this.rights = this.buildPermissionsString(val, this.permissionMedium, this.permissionOriginal)
        },
      },

      permissionMedium: {
        get () {
          if (this.rights.length < 3) return false

          return this.rights.substring(1, 2) === '1'
        },
        set (val) {
          this.rights = this.buildPermissionsString(this.permissionSmall, val, this.permissionOriginal)
        },
      },

      permissionOriginal: {
        get () {
          if (this.rights.length < 3) return false

          return this.rights.substring(2) === '1'
        },
        set (val) {
          this.rights = this.buildPermissionsString(this.permissionSmall, this.permissionMedium, val)
        },
      },
    },

    watch: {
      async searchPhotographer (val) {
        if (this.isLoadingPhotographer) return

        this.isLoadingPhotographer = true
        try {
          const response = await this.$http.get(`photographers?project=catalogue&search=${val}`)
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
          const response = await this.$http.get(`copyrights?project=catalogue&search=${val}`)
          this.copyrights = response.data
        } catch (e) {
          console.log(e)
        } finally {
          this.isLoadingCopyright = false
        }
      },
    },

    mounted () {
      if (this.selectedFile.type === 'image/jpeg') {
        this.fillMetadataFromImage(this.selectedFile.image)
      }
    },

    methods: {
      fillMetadataFromImage (image) {
        if (image.photographer) {
          this.photographers = [{ ...image.photographer }]
          this.photographer_id = image.photographer_id
        }

        if (image.copyright) {
          this.copyrights = [{ ...image.copyright }]
          this.copyright_id = image.copyright_id
        }

        this.date = image.date
        this.nli_picname = image.nli_picname
        this.negative = image.negative
        this.rights = image.rights
      },

      closeEditor () {
        this.$emit('close')
      },

      async save () {
        const payload = {
          metadata: {
            photographer_id: this.photographer_id,
            copyright_id: this.copyright_id,
            date: this.date,
            nli_picname: this.nli_picname,
            negative: this.negative,
            rights: this.rights,
          },
          images: await this.getAllNestedFiles(this.selectedFiles),
        }

        this.isSaving = true
        try {
          const { data } = await this.$http.post('images/metadata?project=catalogue', payload)
          EventHub.fire('MediaManager-metadata-changed', data)
          this.closeEditor()
        } catch (e) {
          EventHub.fire('show-snackbar', { color: 'error', text: 'An error occurred' })
          console.log(e)
        } finally {
          this.isSaving = false
        }
      },

      togglePermissionsInheritance () {
        if (this.permissionsInherited) {
          this.rights = '000'
        } else {
          this.rights = '2'
        }
      },

      buildPermissionsString (permissionSmall, permissionMedium, permissionOriginal) {
        const small = permissionSmall ? '1' : '0'
        const medium = permissionMedium ? '1' : '0'
        const original = permissionOriginal ? '1' : '0'

        return small + medium + original
      },
    },
  }
</script>
