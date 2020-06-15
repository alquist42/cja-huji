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
          </v-col>
          <v-col cols="12">
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
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="6">
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
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="6">
            <template
              v-for="taxon in taxons"
            >
              <v-autocomplete
                :key="taxon"
                v-model="item[taxon]"
                :items="queryItems"
                :loading="isLoading"
                :search-input.sync="search[taxon]"
                color="primary"
                hide-no-data
                hide-selected
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
            </template>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="6">
            <template
              v-for="(prop, i) in item.properties"
            >
              <v-text-field
                v-if="prop.type === 'text'"
                :key="prop.id"
                v-model="prop.pivot.value"
                :label="prop.verbose_name"
                outlined
              />
              <v-textarea
                v-if="prop.type === 'textarea' && prop.content_type === 'plain'"
                :key="prop.id"
                v-model="prop.pivot.value"
                :label="prop.verbose_name"
                outlined
              />
              <tiptap-vuetify
                v-if="prop.type === 'textarea' && prop.content_type === 'htmle'"
                :key="prop.id"
                v-model="prop.pivot.value"
                :placeholder="prop.verbose_name"
                :extensions="extensions"
              />
              <v-select
                v-if="prop.type === 'select'"
                :key="prop.id"
                v-model="item.properties[i].pivot.value"
                :items="prop.allowed_vals.split(' | ')"
                chips
                :label="prop.verbose_name"
                outlined
              />
            </template>
          </v-col>
        </v-row>
      </v-container>

      <!--      <dashboard-core-footer />-->
    </v-content>

    <!--    <dashboard-core-settings />-->
  </v-app>
</template>

<script>

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
      'item',
    ],

    data: () => ({

      queryItems: [],
      search: {},
      isLoading: false,
      type: 'origins',

      taxons: [
        'locations',
        'origins',
        'schools',
        'subjects',
        'historic_origins',
        'periods',
        'collections',
        'communities',
        'origin_details',
      ],

      fields: [
        'id',
        'parent_id',
        'name',
        'publish_state',
        'publish_state_reason',
        'category',
        'ntl',
        'date',
        'reconstruction_dates',
        'activity_dates',
        'copyright_id',
        'remarks',
        'description',
        'addenda',
        'artifact_at_risk',
        'geo_lat',
        'geo_lng',
        'geo_options',
        '_lft',
        '_rgt',

        // 'properties',

        // 'collection_details',
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

    mounted () {
      this.taxons.map(taxon => this.$watch(`taxons.${taxon}`, debounce(function (query) { this.autocomplete(query, taxon) }, 300)))
      console.log(this.item)
    },
    methods: {
      async autocomplete (query, type) {
        console.log(query)
        if (query.length < 2) {
          return
        }
        this.isLoading = true
        const { data } = await this.$http.get(`/api/autocomplete/?type=${type}&project=slovenia&term=${query}`)
        this.isLoading = false
        this.queryItems = data || []
      },
    },
  }
</script>
