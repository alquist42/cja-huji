<template>
  <v-container
    fluid
    tag="section"
  >
    <v-snackbar
      v-model="snackbar"
      :color="snackbarColor"
      top
    >
      {{ snackbarText }}
      <template v-slot:action="{ attrs }">
        <v-btn
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>

    <confirmation-modal
      :value="deleteItemConfirmationDialog"
      title="Delete item"
      :message="`Are you sure you want to delete ${item.name || 'item'}?`"
      :show-no-button="false"
      btn-yes-text="Delete"
      @cancel="deleteItemConfirmationDialog = false"
      @yes="deleteItem"
    />

    <confirmation-modal
      :value="detachImagesConfirmationDialog"
      title="Detach images"
      message="Images are attached to other items. Detach from them?"
      @cancel="cancelCreatingItemFromImages"
      @no="createItemWithoutDetachingImages"
      @yes="createItemDetachingImages"
    />

    <dashboard-core-app-bar :loading="isLoading">
      <template #controls>
        <v-btn
          outlined
          :loading="isSaving"
          :disabled="!isDirty || isLoading"
          @click="save"
        >
          {{ id ? 'Save' : 'Create' }}
        </v-btn>
        <v-btn
          v-if="id"
          class="ml-2"
          outlined
          color="success"
          :loading="isCreatingChild"
          :disabled="isLoading"
          @click="createChild()"
        >
          Create child
          <v-icon right>
            mdi-file-tree
          </v-icon>
        </v-btn>
        <v-btn
          class="ml-2"
          color="error"
          outlined
          :loading="isDeleting"
          :disabled="isLoading || hasImages || !id"
          @click="deleteItemConfirmationDialog = true"
        >
          Delete
          <v-icon right>
            mdi-trash-can-outline
          </v-icon>
        </v-btn>
        <v-btn
          v-if="id"
          class="ml-2"
          style="text-decoration: none"
          color="info"
          outlined
          :disabled="isLoading"
          :href="`/catalogue/items/${id}`"
          target="_blank"
        >
          Preview
          <v-icon right>
            mdi-open-in-new
          </v-icon>
        </v-btn>
      </template>
    </dashboard-core-app-bar>

    <v-row>
      <v-col cols="8">
        <item-basic
          v-model="item"
          :disabled="isLoading"
          @is-copying-attributes:update="isCopyingAttributes = $event"
          @attributes-copied="handleAttributesCopied"
          @error="showSnackbarError('An error occurred')"
          @input="isDirty = true"
        />

        <item-taxonomy
          v-model="item"
          :disabled="isLoading"
          @input="isDirty = true"
          @success="showSnackbarSuccess($event)"
          @error="showSnackbarError('An error occurred')"
        />

        <item-properties
          v-model="item"
          :disabled="isLoading"
          @input="isDirty = true"
        />
      </v-col>

      <v-col cols="4">
        <item-images
          v-model="item"
          :disabled="isLoading"
          @error="showSnackbarError('An error occurred')"
          @success="showSnackbarSuccess($event)"
        />

        <item-settings
          v-model="item"
          :disabled="isLoading"
          @input="isDirty = true"
        />

        <item-base-fields
          v-model="item"
          :disabled="isLoading"
          @input="isDirty = true"
        />

        <item-composition
          v-model="item"
          :disabled="isLoading"
          @input="isDirty = true"
        />

        <item-map
          v-model="item"
          :disabled="isLoading"
          @input="isDirty = true"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  /* global EventHub */

  import { singular } from 'pluralize'
  import CreateItemFromImages from '../mixins/CreateItemFromImages'
  import SnackBar from '../mixins/SnackBar'

  const PUBLISH_STATE_NOT_PUBLISHED = 0

  export default {
    name: 'Item',

    components: {
      DashboardCoreAppBar: () => import('./dashboard/components/core/AppBar'),
      ConfirmationModal: () => import('../components/ConfirmationModal'),
      ItemBasic: () => import('../components/Partials/Item/Basic'),
      ItemImages: () => import('../components/Partials/Item/Images'),
      ItemSettings: () => import('../components/Partials/Item/Settings'),
      ItemBaseFields: () => import('../components/Partials/Item/Dates'),
      ItemComposition: () => import('../components/Partials/Item/Composition'),
      ItemMap: () => import('../components/Partials/Item/Map'),
      ItemTaxonomy: () => import('../components/Partials/Item/Taxonomy'),
      ItemProperties: () => import('../components/Partials/Item/Properties'),
    },

    mixins: [CreateItemFromImages, SnackBar],

    data: () => ({
      deleteItemConfirmationDialog: false,
      isGettingItem: false,
      isSaving: false,
      isDeleting: false,
      isCreatingChild: false,
      isCopyingAttributes: false,
      isDirty: false,
      item: null,
      default: {
        activity_dates: null,
        activity_dates_object: null,
        addenda: '',
        ancestors: [],
        artifact_at_risk: false,
        category: '',
        category_object: {
          name: 'None',
          slug: null,
        },
        children: [],
        collection_details: [],
        collections: [],
        communities: [],
        community_details: [],
        copyright: null,
        copyright_id: null,
        creation_date: null,
        date: null,
        descendants: [],
        description: '',
        geo_lat: null,
        geo_lng: null,
        geo_options: null,
        historical_origins: [],
        id: null,
        images: [],
        leaf: [],
        location_details: [],
        locations: [],
        maker_details: [],
        makers: [],
        name: '',
        ntl: '',
        object_details: [],
        objects: [],
        origin_details: [],
        origins: [],
        period_details: [],
        periods: [],
        projects: [],
        properties: [],
        publish_state: PUBLISH_STATE_NOT_PUBLISHED,
        publish_state_reason: '',
        reconstruction_dates: null,
        reconstruction_dates_object: null,
        remarks: '',
        school_details: [],
        schools: [],
        sites: [],
        subject_details: [],
        subjects: [],
      },
      taxonomy: {
        locations: [],
        origins: [],
        schools: [],
        subjects: [],
        objects: [],
        historical_origins: [],
        periods: [],
        collections: [],
        communities: [],
        sites: [],
        makers: [],
        properties: [],
      },
    }),

    computed: {
      id () {
        return parseInt(this.$route.params.id)
      },

      // origins () {
      //   const self = this.item.origins
      //   const parent = this.item.parent.origins
      // },

      isLoading () {
        return this.isGettingItem || this.isCreatingChild || this.isChanging
      },

      isChanging () {
        return this.isSaving || this.isCopyingAttributes || this.isDeleting
      },

      hasImages () {
        return !!this.item.images.length
      },
    },

    beforeRouteUpdate (to, from, next) {
      if (this.isDirty || this.isChanging) {
        if (!confirm('If you proceed - the changes you made will not be saved. Are you sure?')) return
      }

      next()
      this.getItem()
    },

    beforeRouteLeave (to, from, next) {
      if (!this.isDirty && !this.isChanging) {
        return next()
      }

      const answer = confirm('If you proceed - the changes you made will not be saved. Are you sure?')
      if (answer) {
        next()
      } else {
        next(false)
      }
    },

    watch: {
      '$route.params.id': function (id) {
        this.item = this.default
        this.item.id = id
      },
    },

    created () {
      this.item = this.default
    },

    mounted () {
      this.getItem()
      window.addEventListener('beforeunload', this.beforeLeave)
    },

    beforeDestroy () {
      window.removeEventListener('beforeunload', this.beforeLeave)
    },

    methods: {
      async getItem () {
        this.isGettingItem = true
        try {
          if (this.id) {
            const { data } = await this.$http.get(`items/${this.id}?project=catalogue`)
            this.item = data
          }
          this.isDirty = false
        } catch (e) {
          console.log(e)
        } finally {
          this.isGettingItem = false
        }
      },

      async save () {
        const taxons = [
          'subjects',
          'objects',
          'periods',
          'origins',
          'historical_origins',
          'communities',
          'collections',
          // 'congregations',
          'locations',
          'sites',
          'schools',
          // 'location_details',
          // 'origin_details',
          // 'school_details',
          // 'object_details',
          // 'subject_details',
          // 'historical_origin_details',
          // 'period_details',
          // 'site_details',
          // 'congregation_details',
          // 'collection_details',
          // 'community_details',
        ]

        Object.keys(this.item).forEach(field => {
          if (taxons.includes(field)) {
            this.taxonomy[field] = this.item[field].map(t => {
              const d = `${singular(field)}_details`

              return {
                id: t.id,
                details: this.item[d] && this.item[d][0] && this.item[d][0].details,
              }
            })
          }
        })

        this.taxonomy.makers = this.item.makers.map(maker => {
          return {
            ...maker,
            details: this.item.maker_details && this.item.maker_details[0] && this.item.maker_details[0].details,
          }
        })

        this.taxonomy.properties = this.item.properties.map(t => {
          return {
            property_id: t.pivot.property_id,
            value: t.pivot.value,
          }
        })

        this.isSaving = true
        try {
          if (this.id) {
            const { data } = await this.$http.put(`items/${this.id}?project=catalogue`, {
              item: this.item,
              taxonomy: this.taxonomy,
            })
            this.item.leaf = data.leaf
            console.log(this.item, this.taxonomy)
          } else {
            const { data } = await this.$http.post('items?project=catalogue', {
              item: this.item,
              taxonomy: this.taxonomy,
            })
            this.isSaving = false
            this.isDirty = false
            await this.$router.replace({ name: 'Item', params: { id: data.id } })
            this.getItem()
          }
          this.isDirty = false
          this.showSnackbarSuccess('Item has been saved')
        } catch (e) {
          this.showSnackbarError('An error occurred')
          console.log(e)
        } finally {
          this.isSaving = false
        }
      },

      handleAttributesCopied (item) {
        this.item = item
        this.isDirty = true
        this.showSnackbarSuccess('Attributes have been copied')
      },

      async deleteItem () {
        this.deleteItemConfirmationDialog = false
        this.isDeleting = true
        try {
          await this.$http.delete(`items/${this.id}?project=catalogue`)
          this.showSnackbarSuccess('Item has been deleted')
          this.isDeleting = false
          this.$router.push({ name: 'Items' })
        } catch (e) {
          this.showSnackbarError('An error occurred')
          this.isDeleting = false
          console.log(e)
        }
      },

      async createChild (fromImages = [], detachFrom = []) {
        if (this.isDirty || this.isChanging) {
          if (!confirm('If you proceed - the changes you made will not be saved. Are you sure?')) return
          this.isDirty = false
        }

        const fields = [
          'name',
          'publish_state',
          'publish_state_reason',
          'category',
          'ntl',
          'creation_date',
          'reconstruction_dates_object',
          'activity_dates_object',
          'copyright',
          'remarks',
          'description',
          'addenda',
          'artifact_at_risk',
          'geo_lat',
          'geo_lng',
          'geo_options',
          'projects',
        ]
        const child = {
          parent_id: this.id,
        }

        fields.forEach(field => {
          if (this.item[field]) {
            child[field] = this.item[field]
          }
        })

        this.taxonomy.properties = this.item.properties.map(t => {
          return {
            property_id: t.pivot.property_id,
            value: t.pivot.value,
          }
        })

        this.isCreatingChild = true
        EventHub.fire('MediaManagerModal-modal-creating-child')
        try {
          const { data } = await this.$http.post('items?project=catalogue', {
            item: child,
            taxonomy: this.taxonomy,
            images: fromImages,
            detach_from: detachFrom,
          })
          this.showSnackbarSuccess('Child has been created')
          EventHub.fire('MediaManagerModal-modal-created-child')
          this.$router.push({ name: 'Item', params: { id: data.id } })
        } catch (e) {
          this.showSnackbarError()
          console.log(e)
        } finally {
          this.isCreatingChild = false
        }
      },

      beforeLeave (event) {
        if (this.isDirty || this.isChanging) {
          event.preventDefault()
          event.returnValue = ''
        }
      },
    },
  }
</script>
