<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <div class="display-2 font-weight-light">
        Settings
      </div>
    </template>
    <v-card-text>
      <v-select
        :value="value.category_object"
        :items="possibleCategories"
        :disabled="disabled || isGettingData"
        label="Category"
        item-text="name"
        item-value="slug"
        return-object
        outlined
        @input="update('category_object', $event)"
      />
      <v-select
        :value="value.projects"
        :items="possibleProjects"
        :disabled="disabled || isGettingData"
        label="Projects"
        item-text="title"
        item-value="tag_slug"
        return-object
        multiple
        chips
        deletable-chips
        small-chips
        outlined
        @input="update('projects', $event)"
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
      <v-select
        :value="value.publish_state"
        :items="possiblePublishStates"
        :disabled="disabled || isGettingData"
        label="Publish state"
        outlined
        @input="update('publish_state', $event)"
      />
      <v-text-field
        v-if="value.publish_state === 0"
        :value="value.publish_state_reason"
        :disabled="disabled || isGettingData"
        label="Publish state reason"
        outlined
        @input="update('publish_state_reason', $event)"
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
  import _sortBy from 'lodash/sortBy'

  const PUBLISH_STATE_NOT_PUBLISHED = 0
  const PUBLISH_STATE_PREPARED_FOR_PUBLISHING = 1
  const PUBLISH_STATE_PUBLISHED = 2

  export default {
    name: 'ItemSettings',

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
      isGettingData: false,
      categories: [],
      projects: [],
      copyrights: [],
      searchCopyright: null,
      isLoadingCopyright: false,
    }),

    computed: {
      possibleCategories () {
        const sortedCategories = _sortBy(this.categories, 'name')

        return [
          {
            slug: null,
            name: 'None',
          },
          ...sortedCategories,
        ]
      },

      possibleProjects () {
        return _sortBy(this.projects, 'title')
      },

      possiblePublishStates () {
        return [
          {
            value: PUBLISH_STATE_NOT_PUBLISHED,
            text: 'Not published',
          },
          {
            value: PUBLISH_STATE_PREPARED_FOR_PUBLISHING,
            text: 'Prepared for publishing',
          },
          {
            value: PUBLISH_STATE_PUBLISHED,
            text: 'Published',
          },
        ]
      },
    },

    watch: {
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

    async mounted () {
      this.isGettingData = true
      try {
        let response = await this.$http.get('categories?project=catalogue')
        this.categories = response.data

        response = await this.$http.get('projects?project=catalogue')
        this.projects = response.data
      } catch (e) {
        console.log(e)
      } finally {
        this.isGettingData = false
      }
    },

    methods: {
      update (key, value) {
        const item = { ...this.value, [key]: value }

        if (key === 'category_object') {
          item.category = value.slug
        }

        this.$emit('input', item)
      },
    },
  }
</script>
