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

    <select-item-modal
      :exclude="id"
      :value="copyAttributesFromObjectDialog"
      title="Select object to copy attributes from"
      @cancel="copyAttributesFromObjectDialog = false"
      @input="copyAttributesFromObjectDialog = false; copyAttributesFrom($event)"
    />

    <confirmation-modal
      :value="deleteItemConfirmationDialog"
      title="Delete item"
      :message="`Are you sure you want to delete ${item.name || 'item'}?`"
      btn-confirm-text="Delete"
      @cancel="deleteItemConfirmationDialog = false"
      @confirm="deleteItem"
    />

    <confirmation-modal
      :value="detachImagesConfirmationDialog"
      title="Detach images"
      message="Images are attached to other items. Detach from them?"
      btn-cancel-text="No"
      btn-confirm-text="Yes"
      @cancel="createItemWithoutDetachingImages"
      @confirm="createItemDetachingImages"
    />

    <dashboard-core-app-bar :loading="isLoading">
      <template #controls>
        <v-btn
          outlined
          :loading="isSaving"
          :disabled="isLoading"
          @click="save"
        >
          Save
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
          v-if="id && !hasImages"
          class="ml-2"
          color="error"
          outlined
          :disabled="isLoading"
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
        <item-basic v-model="item">
          <v-tooltip left>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                v-bind="attrs"
                icon
                :loading="isCopyingAttributes"
                :disabled="isLoading"
                v-on="on"
                @click="copyAttributesFromObjectDialog = true"
              >
                <v-icon>mdi-content-copy</v-icon>
              </v-btn>
            </template>
            <span>Copy all attributes from object</span>
          </v-tooltip>
        </item-basic>
        <base-material-card class="px-5 py-3">
          <template v-slot:heading>
            <div class="display-2 font-weight-light">
              Taxonomy
            </div>
          </template>
          <v-card-text>
            <v-row
              v-for="taxon in taxons"
              :key="taxon"
              no-gutters
              class="mb-2"
            >
              <v-col
                cols="12"
                class="pb-0"
              >
                <template v-if="hasParent">
                  <v-tooltip
                    v-if="taxonomyInheritance[taxon] !== 'enabled'"
                    top
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        v-bind="attrs"
                        icon
                        v-on="on"
                        @click="enableTaxonomyInheritance(taxon)"
                      >
                        <v-icon color="grey">
                          mdi-lock-open
                        </v-icon>
                      </v-btn>
                    </template>
                    <span>Enable taxonomy inheritance</span>
                  </v-tooltip>
                  <v-tooltip
                    v-else
                    top
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        v-bind="attrs"
                        icon
                        v-on="on"
                        @click="disableTaxonomyInheritance(taxon)"
                      >
                        <v-icon color="grey">
                          mdi-lock
                        </v-icon>
                      </v-btn>
                    </template>
                    <span>Disable taxonomy inheritance</span>
                  </v-tooltip>
                </template>
                <span class="overline">
                  {{ taxon.replace('_', ' ') }}
                </span>
                <span
                  v-if="taxonomyInheritance[taxon] === 'enabled'"
                  class="caption"
                >
                  (inherited)
                </span>
                <taxon-modal
                  :taxon="taxon"
                  :value="item[taxon] || []"
                  @input="updateTaxon(taxon, $event)"
                />
              </v-col>
              <v-row no-gutters>
                <v-col>
                  <template v-if="taxonomyInheritance[taxon] === 'disabled-own'">
                    <v-chip
                      v-for="obj in item[taxon]"
                      :key="obj.id"
                      class="mb-1 mr-1"
                      close
                      color="green lighten-2"
                      @click:close="removeTaxonItem(taxon, obj.id)"
                    >
                      {{ obj.name }}
                    </v-chip>
                    ({{ details(taxon) }})
                  </template>
                  <v-chip
                    v-else-if="taxonomyInheritance[taxon] === 'disabled-none'"
                    class="mb-1 mr-1"
                    outlined
                    disabled
                  >
                    none
                  </v-chip>
                  <template v-else-if="item.ancestors && item.ancestors[0]">
                    <template v-if="ancestorsTaxonomy[taxon].length">
                      <v-chip
                        v-for="obj in ancestorsTaxonomy[taxon]"
                        :key="obj.id"
                        class="mb-1 mr-1"
                      >
                        {{ obj.name }}
                      </v-chip>
                      <!--({{ details(taxon) }})-->
                    </template>
                    <v-chip
                      v-else
                      class="mb-1 mr-1"
                      outlined
                      disabled
                    >
                      none
                    </v-chip>
                  </template>
                  <v-chip
                    v-else
                    class="mb-1 mr-1"
                    outlined
                    disabled
                  >
                    none
                  </v-chip>
                </v-col>
              </v-row>
            </v-row>
            <v-row
              no-gutters
              class="mb-2"
            >
              <v-col
                cols="12"
                class="pb-0"
              >
                <span class="overline">Makers</span>
                <taxon-maker-modal @input="addMaker" />
              </v-col>
              <v-col cols="12">
                <v-chip
                  v-for="obj in item.makers"
                  :key="obj.id"
                  class="mb-1 mr-1"
                  close
                  color="green lighten-2"
                  @click:close="removeTaxonItem('makers', obj.id)"
                >
                  {{ obj.artist.name }} ({{ obj.profession.name }})
                </v-chip>
                ({{ details('makers') }})
              </v-col>
            </v-row>
          </v-card-text>
        </base-material-card>

        <base-material-card class="px-5 py-3">
          <template v-slot:heading>
            <div class="display-2 font-weight-light">
              Properties
            </div>
          </template>
          <v-card-text>
            <v-expansion-panels
              v-model="panel"
              multiple
            >
              <v-expansion-panel
                v-for="categName in Object.keys(propers)"
                :key="categName"
              >
                <v-expansion-panel-header>
                  <span class="overline">{{ categName.replace('_', ' ') }}</span>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                  <template v-for="(prop, i) in propers[categName]">
                    <v-text-field
                      v-if="prop.type === 'text'"
                      :key="prop.id"
                      :label="prop.verbose_name"
                      outlined
                      :value="getItemPropValue(prop.prop_name)"
                      @input="setItemPropValue(prop, $event)"
                    >
                      <template v-slot:prepend>
                        <v-badge :content="i+1" />
                      </template>
                    </v-text-field>
                    <v-textarea
                      v-if="prop.type === 'textarea' && prop.content_type === 'plain'"
                      :key="prop.id"
                      :label="prop.verbose_name"
                      outlined
                      :value="getItemPropValue(prop.prop_name)"
                      @input="setItemPropValue(prop, $event)"
                    />
                    <tiptap-vuetify
                      v-if="prop.type === 'textarea' && prop.content_type === 'htmle'"
                      :key="prop.id"
                      :placeholder="prop.verbose_name"
                      :extensions="extensions"
                      :value="getItemPropValue(prop.prop_name)"
                      @input="setItemPropValue(prop, $event)"
                    />
                    <v-select
                      v-if="prop.type === 'select'"
                      :key="prop.id"
                      :items="prop.allowed_vals.split(' | ')"
                      chips
                      :label="prop.verbose_name"
                      outlined
                      :value="getItemPropValue(prop.prop_name)"
                      @input="setItemPropValue(prop, $event)"
                    />
                  </template>
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-card-text>
        </base-material-card>
      </v-col>

      <v-col cols="4">
        <base-material-card class="px-5 py-3">
          <template v-slot:heading>
            <v-row no-gutters>
              <v-col class="flex-grow-1 display-2 font-weight-light">
                Images: {{ item.images ? item.images.length : '0' }}
              </v-col>
              <v-col
                cols="auto"
                class="d-flex align-center"
              >
                <v-btn
                  icon
                  :disabled="isLoading || !id"
                  @click="openMediaManagerModal"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </v-col>
            </v-row>
          </template>
          <v-card-text>
            <v-carousel height="250">
              <v-carousel-item
                v-for="image in item.images"
                :key="image.id"
              >
                <v-img
                  :lazy-src="`/storage/${image.small || image.medium || image.def || image.batch_url}`"
                  :src="`http://cja.huji.ac.il/${image.small || image.medium || image.def || image.batch_url}`"
                  max-height="250px"
                  contain
                />
              </v-carousel-item>
            </v-carousel>
          </v-card-text>
        </base-material-card>

        <base-material-card class="px-5 py-3">
          <template v-slot:heading>
            <div class="display-2 font-weight-light">
              Settings
            </div>
          </template>
          <v-card-text>
            <v-select
              v-model="item.category_object"
              :items="possibleCategories"
              label="Category"
              item-text="name"
              item-value="slug"
              return-object
              outlined
            />
            <v-select
              v-model="item.projects"
              :items="possibleProjects"
              label="Projects"
              item-text="title"
              item-value="tag_slug"
              return-object
              multiple
              chips
              deletable-chips
              small-chips
              outlined
            />
            <v-select
              v-model="item.publish_state"
              :items="possiblePublishStates"
              label="Publish state"
              outlined
            />
            <v-text-field
              v-model="item.publish_state_reason"
              label="Publish state reason"
              outlined
            />
          </v-card-text>
        </base-material-card>

        <base-material-card class="px-5 py-3">
          <template v-slot:heading>
            <div class="display-2 font-weight-light">
              Base Fields
            </div>
          </template>
          <v-card-text>
            <v-combobox
              v-model="item.creation_date"
              :items="dates"
              :search-input.sync="searchDate"
              item-value="id"
              item-text="name"
              label="Creation date"
              placeholder="Start typing to search"
              outlined
              :loading="isLoadingDates"
            />
            <v-combobox
              v-model="item.reconstruction_dates_object"
              :items="reconstructionDates"
              :search-input.sync="searchReconstructionDates"
              item-value="id"
              item-text="name"
              label="Reconstruction dates"
              placeholder="Start typing to search"
              outlined
              :loading="isLoadingReconstructionDates"
            />
            <v-combobox
              v-model="item.activity_dates_object"
              :items="activityDates"
              :search-input.sync="searchActivityDates"
              item-value="id"
              item-text="name"
              label="Activity dates"
              placeholder="Start typing to search"
              outlined
              :loading="isLoadingActivityDates"
            />
            <v-combobox
              v-model="item.copyright"
              :items="copyrights"
              :search-input.sync="searchCopyright"
              item-value="id"
              item-text="name"
              label="Copyright"
              placeholder="Start typing to search"
              outlined
              :loading="isLoadingCopyright"
            />
            <v-textarea
              v-model="item.remarks"
              label="Remarks"
              outlined
              counter="200"
              no-resize
            />
            <v-switch
              v-model="item.artifact_at_risk"
              label="Artifact at risk"
              inset
            />
          </v-card-text>
        </base-material-card>

        <base-material-card class="px-5 py-3">
          <template v-slot:heading>
            <div class="display-2 font-weight-light">
              Item's Composition
            </div>
          </template>
          <v-card-text>
            <v-treeview
              open-on-click
              :active="compositionTreeActive"
              :open="compositionTreeOpen"
              :items="item.leaf"
            >
              <template #append="{ item: treeItem }">
                <a
                  v-if="id !== treeItem.id"
                  :href="`/staff/items/${treeItem.id}`"
                  style="text-decoration: none;"
                >
                  <v-icon>mdi-arrow-right-bold-box</v-icon>
                </a>
              </template>
            </v-treeview>
          </v-card-text>
        </base-material-card>

        <base-material-card class="px-5 py-3">
          <template v-slot:heading>
            <div class="display-2 font-weight-light">
              Map
            </div>
          </template>
          <v-card-text>
            <v-text-field
              v-model="item.geo_lat"
              label="Latitude"
              type="number"
              outlined
            />
            <v-text-field
              v-model="item.geo_lng"
              label="Longitude"
              type="number"
              outlined
            />
            <v-text-field
              v-model="item.geo_options"
              outlined
              label="Geolocation options"
            />
          </v-card-text>
        </base-material-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  /* global EventHub */

  import { singular } from 'pluralize'
  import { TiptapVuetify, Heading, Bold, Italic, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'
  import _sortBy from 'lodash/sortBy'
  import CreateItemFromImages from '../mixins/CreateItemFromImages'
  import SnackBar from '../mixins/SnackBar'

  const PUBLISH_STATE_NOT_PUBLISHED = 0
  const PUBLISH_STATE_PREPARED_FOR_PUBLISHING = 1
  const PUBLISH_STATE_PUBLISHED = 2

  const groupBy = function (xs, key) {
    return xs.reduce(function (rv, x) {
      (rv[x[key]] = rv[x[key]] || []).push(x)
      return rv
    }, {})
  }

  export default {
    name: 'Item',

    components: {
      TiptapVuetify,
      DashboardCoreAppBar: () => import('./dashboard/components/core/AppBar'),
      TaxonModal: () => import('../components/TaxonModal'),
      TaxonMakerModal: () => import('../components/TaxonMakerModal'),
      SelectItemModal: () => import('../components/SelectItemModal'),
      ConfirmationModal: () => import('../components/ConfirmationModal'),
      ItemBasic: () => import('../components/ItemBasic'),
    },

    mixins: [CreateItemFromImages, SnackBar],

    data: () => ({
      copyAttributesFromObjectDialog: false,
      deleteItemConfirmationDialog: false,
      isGettingItem: false,
      isSaving: false,
      isCreatingChild: false,
      isCopyingAttributes: false,
      item: {
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

      panel: [],

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

      taxons: [
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
      ],

      extensions: [
        History,
        Blockquote,
        Link,
        Underline,
        Strike,
        Italic,
        ListItem,
        BulletList,
        OrderedList,
        [Heading, {
          options: {
            levels: [1, 2, 3],
          },
        }],
        Bold,
        Code,
        HorizontalRule,
        Paragraph,
        HardBreak,
      ],

      properties: [],
      categories: [],
      projects: [],
      dates: [],
      searchDate: null,
      isLoadingDates: false,
      reconstructionDates: [],
      searchReconstructionDates: null,
      isLoadingReconstructionDates: false,
      activityDates: [],
      searchActivityDates: null,
      isLoadingActivityDates: false,
      copyrights: [],
      searchCopyright: null,
      isLoadingCopyright: false,
    }),

    computed: {
      id () {
        return parseInt(this.$route.params.id)
      },

      propers () {
        const sortedProperties = _sortBy(this.properties, 'categ_name')

        return groupBy(sortedProperties, 'categ_name')
      },

      // origins () {
      //   const self = this.item.origins
      //   const parent = this.item.parent.origins
      // },

      details () {
        return (name) => {
          const field = `${singular(name)}_details`
          return this.item[field] && this.item[field][0] && this.item[field][0].details
        }
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

      compositionTreeOpen () {
        return this.item.ancestors.map(item => item.id).concat([this.id])
      },

      compositionTreeActive () {
        return this.item.leaf.length ? [this.id] : []
      },

      taxonomyInheritance () {
        // eslint-disable-next-line
        let taxonomyInheritance = {}

        this.taxons.forEach(taxonName => {
          const taxons = this.item[taxonName]
          if (!taxons || taxons.length === 0) {
            taxonomyInheritance[taxonName] = 'enabled' // blank - inheritance enabled
          } else if (taxons[0].id === -1) {
            taxonomyInheritance[taxonName] = 'disabled-none' // -1 (unknown) - inheritance disabled - but show nothing
          } else {
            taxonomyInheritance[taxonName] = 'disabled-own' // other own value - inheritance disabled
          }
        })

        return taxonomyInheritance
      },

      ancestorsTaxonomy () {
        // eslint-disable-next-line
        let taxonomy = {}

        this.taxons.forEach(taxonName => {
          let taxonValue = []

          for (const ancestor of this.item.ancestors) {
            if (ancestor[taxonName].length) {
              if (ancestor[taxonName][0].id !== -1) {
                taxonValue = ancestor[taxonName]
              }
              break
            }
          }

          taxonomy[taxonName] = taxonValue
        })

        return taxonomy
      },

      isLoading () {
        return this.isGettingItem || this.isSaving || this.isCreatingChild || this.isCopyingAttributes
      },

      hasParent () {
        return this.item.ancestors.length
      },

      hasImages () {
        return this.item.images.length
      },
    },

    watch: {
      async searchDate (val) {
        if (this.isLoadingDates) return

        this.isLoadingDates = true
        try {
          const response = await this.$http.get(`dates?project=catalogue&search=${val}`)
          this.dates = response.data
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
          const response = await this.$http.get(`dates?project=catalogue&search=${val}`)
          this.reconstructionDates = response.data
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
          const response = await this.$http.get(`dates?project=catalogue&search=${val}`)
          this.activityDates = response.data
        } catch (e) {
          console.log(e)
        } finally {
          this.isLoadingActivityDates = false
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

      'item.category_object' (val) {
        if (val) {
          this.item.category = val.slug
        }
      },
    },

    created () {
      EventHub.listen('MediaManagerModal-include-images-in-item', (images) => this.includeImages(images))
      EventHub.listen('MediaManagerModal-exclude-images-from-item', (images) => this.excludeImages(images))
      EventHub.listen('MediaManagerModal-files-deleted', (/* files */) => this.updateImages())
    },

    mounted () {
      this.getItem()
    },

    beforeDestroy () {
      EventHub.removeListenersFrom([
        'MediaManagerModal-include-images-in-item',
        'MediaManagerModal-exclude-images-from-item',
        'MediaManagerModal-files-deleted',
      ])
    },

    methods: {
      async getItem () {
        this.isGettingItem = true
        try {
          let response

          if (this.id) {
            response = await this.$http.get(`items/${this.id}?project=catalogue`)
            this.item = response.data
          }

          response = await this.$http.get('categories?project=catalogue')
          this.categories = response.data

          response = await this.$http.get('properties?project=catalogue')
          this.properties = response.data

          response = await this.$http.get('projects?project=catalogue')
          this.projects = response.data

          this.updatePropertiesPanels()
          console.log(this.item)
        } catch (e) {
          console.log(e)
        } finally {
          this.isGettingItem = false
        }
      },

      updatePropertiesPanels () {
        this.panel = []

        Object.keys(this.propers).forEach((categName, categIndex) => {
          this.propers[categName].forEach((prop) => {
            const pr = this.item.properties.find(p => p.prop_name === prop.prop_name)
            console.log(categName, pr, prop.prop_name, categIndex)
            if (pr) {
              this.panel.push(categIndex)
            }
          })
        })
      },

      async save () {
        Object.keys(this.item).forEach(field => {
          if (this.taxons.includes(field)) {
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
            await this.$router.replace({ name: 'Item', params: { id: data.id } })
            this.getItem()
          }
          this.showSnackbarSuccess('Item has been saved')
        } catch (e) {
          this.showSnackbarError('An error occurred')
          console.log(e)
        } finally {
          this.isSaving = false
        }
      },

      updateTaxon (taxonName, taxonItems) {
        this.item[taxonName] = []

        taxonItems.forEach(taxonItem => this.item[taxonName].push(taxonItem))
      },

      removeTaxonItem (taxonName, itemId) {
        this.item[taxonName] = this.item[taxonName].filter(taxonItem => taxonItem.id !== itemId)
      },

      addMaker (maker) {
        this.item.makers.push(maker)
      },

      getItemPropValue (propName) {
        const p = this.item.properties && this.item.properties.find(p => p.prop_name === propName)

        return p ? p.pivot.value : ''
      },

      setItemPropValue (prop, newValue) {
        const propIndex = this.item.properties.findIndex(p => p.prop_name === prop.prop_name)

        if (propIndex !== -1) {
          this.item.properties[propIndex].pivot.value = newValue

          return
        }

        this.item.properties.push({
          ...prop,
          pivot: {
            property_id: prop.id,
            value: newValue,
          },
        })
      },

      openMediaManagerModal () {
        EventHub.fire('show-media-manager-dialog', this.id)
      },

      async includeImages (includingImages) {
        // eslint-disable-next-line
        let images = this.item.images.slice(0)

        includingImages.forEach(includingImage => {
          if (!this.item.images.find(img => img.id === includingImage.image.id)) {
            images.push(includingImage)
          }
        })

        try {
          const { data } = await this.$http.put(`items/${this.id}/images?project=catalogue`, { images })

          this.item.images = data
          this.showSnackbarSuccess('Images have been included')
        } catch (e) {
          this.showSnackbarError()
        }
      },

      async excludeImages (excludingImages) {
        // eslint-disable-next-line
        let images = this.item.images.slice(0)

        excludingImages.forEach(excludingImage => {
          const index = images.findIndex(img => img.id === excludingImage.image.id)

          if (index !== -1) {
            images.splice(index, 1)
          }
        })

        try {
          const { data } = await this.$http.put(`items/${this.id}/images?project=catalogue`, { images })

          this.item.images = data
          EventHub.fire('MediaManagerModal-images-excluded-from-item')
          this.showSnackbarSuccess('Images have been excluded')
        } catch (e) {
          this.showSnackbarError()
        }
      },

      async updateImages () {
        try {
          const { data } = await this.$http.get(`items/${this.id}?project=catalogue`)

          this.item.images = data.images
        } catch (e) {
          console.error(e)
        }
      },

      enableTaxonomyInheritance (taxonName) {
        this.item[taxonName] = []
      },

      disableTaxonomyInheritance (taxonName) {
        this.item[taxonName] = [{ id: -1, name: 'unknown' }]
      },

      async copyAttributesFrom (itemId) {
        this.isCopyingAttributes = true
        try {
          const { data } = await this.$http.get(`items/${itemId}?project=catalogue`)

          const keepOriginal = [
            'id',
            'old_id',
            'parent_id',
            'images',
            'children',
            'ancestors',
            'descendants',
            'leaf',
          ]
          Object.keys(this.item).forEach(field => {
            if (!keepOriginal.includes(field)) {
              this.item[field] = data[field]
            }
          })

          this.updatePropertiesPanels()
          this.showSnackbarSuccess('Attributes have been copied')
        } catch (e) {
          this.showSnackbarError('An error occurred')
          console.log(e)
        } finally {
          this.isCopyingAttributes = false
        }
      },

      async deleteItem () {
        try {
          await this.$http.delete(`items/${this.id}?project=catalogue`)
          this.$router.push({ name: 'Items' })
        } catch (e) {
          this.showSnackbarError('An error occurred')
          console.log(e)
        } finally {
          this.deleteItemConfirmationDialog = false
        }
      },

      async createChild (fromImages = []) {
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
        try {
          const { data } = await this.$http.post('items?project=catalogue', {
            item: child,
            taxonomy: this.taxonomy,
            images: fromImages,
          })
          this.showSnackbarSuccess('Child has been created')
          window.location.href = `/staff/items/${data.id}`
        } catch (e) {
          this.showSnackbarError('An error occurred')
          console.log(e)
        } finally {
          this.isCreatingChild = false
        }
      },
    },
  }
</script>