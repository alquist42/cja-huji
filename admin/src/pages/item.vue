<template>
  <v-app>
    <v-snackbar
      v-model="snackbar"
      :color="snackbarColor"
      top
    >
      {{ snackbarText }}
      <template v-slot:action="{ attrs }">
        <v-btn
          dark
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>

    <dashboard-core-app-bar>
      <v-btn
        outlined
        @click="save"
        :loading="isSaving"
        :disabled="isSaving"
      >
        Save
      </v-btn>
    </dashboard-core-app-bar>

    <dashboard-core-drawer />

    <v-content>
      <v-container
        id="user-profile"
        fluid
        tag="section"
      >
        <v-row>
          <v-col cols="8">
            <base-material-card class="px-5 py-3">
              <template v-slot:heading>
                <div class="display-2 font-weight-light">
                  Item {{ item.id }}
                </div>
              </template>
              <v-card-text>
                <v-form
                  ref="form"
                  lazy-validation
                >
                  <v-text-field
                    v-model="item.name"
                    :counter="10"
                    label="Name"
                    required
                    outlined
                  />

                  <v-text-field
                    v-model="item.ntl"
                    label="NTL"
                    required
                    outlined
                  />

                  <tiptap-vuetify
                    v-model="item.description"
                    :extensions="extensions"
                  />
                </v-form>
              </v-card-text>
            </base-material-card>

            <base-material-card class="px-5 py-3">
              <template v-slot:heading>
                <div class="display-2 font-weight-light">
                  Attributes
                </div>
              </template>
              <v-card-text>
                <template
                  v-for="taxon in taxons"
                >
                  <v-row :key="taxon">
                    <v-col
                      v-if="item[taxon] && item[taxon].length"
                      cols="6"
                    >
                      <template v-for="obj in item[taxon]">
                        <v-chip :key="obj.id">
                          {{ obj.name }}
                        </v-chip>
                      </template>
                      ({{ details(taxon) }})
                    </v-col>
                    <v-col
                      v-if="item.parent && item.parent[0]"
                      cols="6"
                    >
                      <template v-for="obj in item.parent[0][taxon]">
                        <v-chip :key="obj.id">
                          {{ obj.name }}
                        </v-chip>
                      </template>
                      <!--                      ({{ details(taxon) }})-->
                    </v-col>
                    <v-col
                      cols="6"
                    >
                      <v-autocomplete
                        v-model="item[taxon]"
                        :disabled="item[taxon] && item[taxon].length === 0"
                        :items="queryItems"
                        :loading="isLoading"
                        :search-input.sync="search[taxon]"
                        color="primary"
                        item-text="name"
                        item-value="id"
                        :label="taxon"
                        placeholder="Start typing to Search"
                        return-object
                        multiple
                        chips
                        outlined
                        @click="type = taxon"
                      />
                    </v-col>
                  </v-row>
                </template>
                <v-row>
                  <v-col cols="6">
                    <template v-for="obj in item.makers">
                      <v-chip :key="obj.id">
                        {{ obj.artist.name }} ({{ obj.profession.name }})
                      </v-chip>
                    </template>
                    ({{ details('makers') }})
                  </v-col>
                  <v-col cols="6">
                    <v-autocomplete
                      v-model="item['artists']"
                      :items="queryItems"
                      :loading="isLoading"
                      :search-input.sync="search['artists']"
                      color="primary"
                      item-text="name"
                      item-value="id"
                      label="Artists"
                      placeholder="Start typing to Search"
                      return-object
                      multiple
                      chips
                      outlined
                      @click="type = 'artists'"
                    />

                    <v-autocomplete
                      v-model="item['professions']"
                      :items="queryItems"
                      :loading="isLoading"
                      :search-input.sync="search['professions']"
                      color="primary"
                      item-text="name"
                      item-value="id"
                      label="Professions"
                      placeholder="Start typing to Search"
                      return-object
                      multiple
                      chips
                      outlined
                      @click="type = 'professions'"
                    />
                  </v-col>
                </v-row>

                <v-expansion-panels
                  v-model="panel"
                  multiple
                >
                  <v-expansion-panel
                    v-for="(categ, i) in Object.keys(propers)"
                    :key="i"
                  >
                    <v-expansion-panel-header>{{ categ }}</v-expansion-panel-header>
                    <v-expansion-panel-content>
                      <template
                        v-for="(prop, i) in propers[categ]"
                      >
                        <v-text-field
                          v-if="prop.type === 'text'"
                          :key="prop.id"
                          v-model="itemProp(prop.prop_name).pivot.value"
                          :label="prop.verbose_name"
                          outlined
                        >
                          <template v-slot:prepend>
                            <v-badge :content="i+1" />
                          </template>
                        </v-text-field>
                        <v-textarea
                          v-if="prop.type === 'textarea' && prop.content_type === 'plain'"
                          :key="prop.id"
                          v-model="itemProp(prop.prop_name).pivot.value"
                          :label="prop.verbose_name"
                          outlined
                        />
                        <tiptap-vuetify
                          v-if="prop.type === 'textarea' && prop.content_type === 'htmle'"
                          :key="prop.id"
                          v-model="itemProp(prop.prop_name).pivot.value"
                          :placeholder="prop.verbose_name"
                          :extensions="extensions"
                        />
                        <v-select
                          v-if="prop.type === 'select'"
                          :key="prop.id"
                          v-model="itemProp(prop.prop_name).pivot.value"
                          :items="prop.allowed_vals.split(' | ')"
                          chips
                          :label="prop.verbose_name"
                          outlined
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
                <div class="display-2 font-weight-light">
                  Images
                </div>
              </template>
              <v-card-text>
                <template
                  v-for="image in item.images"
                >
                  <v-img
                    :key="image.id"
                    aspect-ratio="1.7"
                    max-height="250px"
                    :src="`http://cja.huji.ac.il/${image.small || image.medium || image.def || image.batch_url}`"
                  />
                </template>
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
                  :items = possibleCategories
                  label="Category"
                  v-model="item.category_object"
                  item-text="name"
                  item-value="slug"
                  return-object
                  outlined
                />
                <v-select
                  :items = possiblePublishStates
                  label="Publish state"
                  v-model="item.publish_state"
                  outlined
                />
                <v-text-field
                  label="Publish state reason"
                  v-model="item.publish_state_reason"
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
                <v-text-field
                  v-for="field in fields"
                  :key="field"
                  v-model="item[field]"
                  outlined
                  :label="field"
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
                <v-treeview :items="item.leaf" />
              </v-card-text>
            </base-material-card>

            <base-material-card class="px-5 py-3">
              <template v-slot:heading>
                <div class="display-2 font-weight-light">
                  Map
                </div>
              </template>
              <v-card-text>
                <template
                  v-for="field in map"
                >
                  <v-text-field
                    :key="field"
                    v-model="item[field]"
                    outlined
                    :label="field"
                  />
                </template>
              </v-card-text>
            </base-material-card>
          </v-col>
        </v-row>
      </v-container>

      <!--      <dashboard-core-footer />-->
    </v-content>

    <!--    <dashboard-core-settings />-->
  </v-app>
</template>

<script>

  import { singular } from 'pluralize'
  import { TiptapVuetify, Heading, Bold, Italic, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'

  const PUBLISH_STATE_NOT_PUBLISHED = 0
  const PUBLISH_STATE_PREPARED_FOR_PUBLISHING = 1
  const PUBLISH_STATE_PUBLISHED = 2

  function debounce (func, wait, immediate) {
    let timeout

    return function executedFunction () {
      const context = this
      const args = arguments

      const later = function () {
        timeout = null
        if (!immediate) func.apply(context, args)
      }

      const callNow = immediate && !timeout

      clearTimeout(timeout)

      timeout = setTimeout(later, wait)

      if (callNow) func.apply(context, args)
    }
  }

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
      DashboardCoreAppBar: () => import('../views/dashboard/components/core/AppBar'),
      DashboardCoreDrawer: () => import('../views/dashboard/components/core/Drawer'),
      // DashboardCoreSettings: () => import('./components/core/Settings'),
      // DashboardCoreView: () => import('../components/core/View'),
    },

    props: [
      'id', 'properties',
    ],

    data: () => ({
      queryItems: [],
      search: {},
      isLoading: false,
      isSaving: false,
      snackbar: false,
      snackbarText: '',
      snackbarColor: '',
      type: 'origins',
      item: {},

      panel: [],

      taxonomy: {
        locations: [],
        origins: [],
        schools: [],
        subjects: [],
        objects: [],
        historic_origins: [],
        periods: [],
        collections: [],
        communities: [],
        sites: [],
        properties: [],
      },

      taxons: [
        'locations',
        'origins',
        'schools',
        'subjects',
        'objects',
        'historic_origins',
        'periods',
        'collections',
        // 'congregations',
        'communities',
        'sites',
        // 'makers',
        // 'location_details',
        // 'origin_details',
        // 'school_details',
        // 'object_details',
        // 'subject_details',
        //        'historic_origin_details',
        // 'period_details',
        //        'site_details',
        //        'congregation_details',
        // 'collection_details',
        // 'community_details',
        // 'maker_details',
      ],

      map: [
        'geo_lat',
        'geo_lng',
        'geo_options',
      ],

      fields: [
        // 'id',
        // 'parent_id',
        // 'name',

        // 'ntl',
        // 'description',
        // 'addenda',

        // '_lft',
        // '_rgt',

        // 'properties',

        // 'makers',
        // 'creation_date',
        // 'items',
        // 'images',
        // 'children',
        // 'ancestors',
        // 'descendants',
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

      categories: [],
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
      propers () {
        return groupBy(this.properties, 'categ_name')
      },
      // origins () {
      //   const self = this.item.origins
      //   const parent = this.item.parent.origins
      // },
      itemProp () {
        return (name) => {
          const p = this.item.properties && this.item.properties.find(p => {
            return p.prop_name === name
          })
          return p || { pivot: { value: '' } }
        }
      },
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
        const sortedCategories = this.categories.slice(0).sort((a, b) => {
          if (a.name === b.name) {
            return 0
          }

          return (a.name > b.name) ? 1 : -1
        })

        return [
          {
            slug: null,
            name: 'None',
          },
          ...sortedCategories,
        ]
      },
    },

    watch: {
      async searchDate (val) {
        if (this.isLoadingDates) return

        this.isLoadingDates = true
        try {
          const response = await this.$http.get(`/api/dates?project=catalogue&search=${val}`)
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
          const response = await this.$http.get(`/api/dates?project=catalogue&search=${val}`)
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
          const response = await this.$http.get(`/api/dates?project=catalogue&search=${val}`)
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
          const response = await this.$http.get(`/api/copyrights?project=catalogue&search=${val}`)
          this.copyrights = response.data
        } catch (e) {
          console.log(e)
        } finally {
          this.isLoadingCopyright = false
        }
      },
    },

    async mounted () {
      this.taxons.concat(['artists', 'professions']).map(taxon => this.$watch(`search.${taxon}`, debounce(function (query) { this.autocomplete(query, taxon) }, 300)))
      let response = await this.$http.get(`/api/items/${this.id}?project=catalogue`)
      this.item = response.data

      response = await this.$http.get('/api/categories?project=catalogue')
      this.categories = response.data

      Object.keys(this.propers).forEach((categ, i) => {
        this.propers[categ].forEach((prop) => {
          const pr = this.item.properties.find(p => {
            return p.prop_name === prop.prop_name
          })
          console.log(categ, pr, prop.prop_name, i)
          if (pr) {
            this.panel.push(i)
          }
        })
      })

      console.log(this.item)
    },

    methods: {
      async autocomplete (query, type) {
        console.log(query)
        if (!query || query.length < 2) {
          return
        }
        this.isLoading = true
        const { data } = await this.$http.get(`/api/autocomplete/?type=${type}&project=catalogue&term=${query}`)
        this.isLoading = false
        this.queryItems = data || []
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
        this.taxonomy.properties = this.item.properties.map(t => {
          return {
            property_id: t.pivot.property_id,
            value: t.pivot.value,
          }
        })
        const item = {
          ...this.item,
          category: this.item.category_object.slug,
        }

        this.isSaving = true
        try {
          await this.$http.put('/api/items/' + this.id + '?project=slovenia', { item: item, taxonomy: this.taxonomy })
          this.showSnackbar('success', 'Item has been saved')
          console.log(this.item, this.taxonomy)
        } catch (e) {
          this.showSnackbar('error', 'An error occurred')
          console.log(e)
        } finally {
          this.isSaving = false
        }
      },

      showSnackbar (color, text) {
        this.snackbarColor = color
        this.snackbarText = text
        this.snackbar = true
      },
    },
  }
</script>
