<template>
  <v-app>
    <dashboard-core-app-bar />

    <dashboard-core-drawer />

    <v-content>
      <v-container
        id="user-profile"
        fluid
        tag="section"
      >
        <v-row>
          <v-col cols="12">
            <v-btn @click="save">
              Save
            </v-btn>
          </v-col>
        </v-row>
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
                <template
                  v-for="field in settings"
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

            <base-material-card class="px-5 py-3">
              <template v-slot:heading>
                <div class="display-2 font-weight-light">
                  Base Fields
                </div>
              </template>
              <v-card-text>
                <template
                  v-for="field in fields"
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
    name: 'DashboardIndex',

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

      settings: [
        'category',
        'publish_state',
        'publish_state_reason',

      ],

      fields: [
        // 'id',
        // 'parent_id',
        // 'name',

        // 'ntl',
        'date',
        'reconstruction_dates',
        'activity_dates',
        'category_object',
        'creation_date',
        'copyright_id',
        'remarks',
        // 'description',
        // 'addenda',
        'artifact_at_risk',

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
    },

    async mounted () {
      this.taxons.concat(['artists', 'professions']).map(taxon => this.$watch(`search.${taxon}`, debounce(function (query) { this.autocomplete(query, taxon) }, 300)))
      const response = await this.$http.get('/api/items/' + this.id + '?project=catalogue')
      this.item = response.data

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
        await this.$http.put('/api/items/' + this.id + '?project=slovenia', { item: this.item, taxonomy: this.taxonomy })
        console.log(this.item, this.taxonomy)
      },
    },
  }
</script>
