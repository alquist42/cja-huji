<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <div class="display-2 font-weight-light">
        Additional Properties
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
                :disabled="disabled || isGettingData"
                outlined
                :value="getPropValue(prop.prop_name)"
                @input="setPropValue(prop, $event)"
              >
                <template v-slot:prepend>
                  <v-badge :content="i+1" />
                </template>
              </v-text-field>
              <v-textarea
                v-if="prop.type === 'textarea' && prop.content_type === 'plain'"
                :key="prop.id"
                :label="prop.verbose_name"
                :disabled="disabled || isGettingData"
                outlined
                :value="getPropValue(prop.prop_name)"
                @input="setPropValue(prop, $event)"
              />
              <tiptap-vuetify
                v-if="prop.type === 'textarea' && ['htmle', 'html'].includes(prop.content_type)"
                :key="prop.id"
                :placeholder="prop.verbose_name"
                :extensions="extensions"
                :disabled="disabled || isGettingData"
                :value="getPropValue(prop.prop_name)"
                @input="setPropValue(prop, $event)"
              />
              <v-select
                v-if="prop.type === 'select'"
                :key="prop.id"
                :items="prop.allowed_vals.split(' | ')"
                chips
                :label="prop.verbose_name"
                :disabled="disabled || isGettingData"
                outlined
                :value="getPropValue(prop.prop_name)"
                @input="setPropValue(prop, $event)"
              />
            </template>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-card-text>
  </base-material-card>
</template>

<script>
  import { TiptapVuetify, Heading, Bold, Italic, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'
  import _sortBy from 'lodash/sortBy'

  export default {
    name: 'ItemProperties',

    components: {
      TiptapVuetify,
    },

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
      panel: [],
      properties: [],
      cachedProperties: [],
    }),

    computed: {
      propers () {
        const sortedProperties = _sortBy(this.properties, 'categ_name')

        return this.groupBy(sortedProperties, 'categ_name')
      },
    },

    watch: {
      'value.properties' (val) {
        const different = val.some(property => {
          const cachedProperty = this.cachedProperties.find(p => p.id === property.id)
          if (!cachedProperty) return true

          return property.pivot.value !== cachedProperty.pivot.value
        })

        if (different || val.length < this.cachedProperties.length) {
          this.updatePanels()
        }
      },
    },

    created () {
      this.getProperties()
    },

    methods: {
      async getProperties () {
        this.isGettingData = true
        try {
          const { data } = await this.$http.get('properties?project=catalogue')
          this.properties = data
        } catch (e) {
          console.log(e)
        } finally {
          this.isGettingData = false
        }
      },

      groupBy (xs, key) {
        return xs.reduce(function (rv, x) {
          (rv[x[key]] = rv[x[key]] || []).push(x)
          return rv
        }, {})
      },

      async updatePanels () {
        this.panel = []
        if (!this.properties.length) {
          await this.getProperties()
        }

        Object.keys(this.propers).forEach((categName, categIndex) => {
          this.propers[categName].forEach((prop) => {
            const pr = this.value.properties.find(p => p.prop_name === prop.prop_name)
            console.log(categName, pr, prop.prop_name, categIndex)
            if (pr) {
              this.panel.push(categIndex)
            }
          })
        })
      },

      getPropValue (propName) {
        const p = this.value.properties.find(p => p.prop_name === propName)

        return p ? p.pivot.value : ''
      },

      setPropValue (prop, newValue) {
        this.cachedProperties = [...this.value.properties]
        const propIndex = this.cachedProperties.findIndex(p => p.prop_name === prop.prop_name)

        if (propIndex === -1) {
          this.cachedProperties.push({
            ...prop,
            pivot: {
              property_id: prop.id,
              value: newValue,
            },
          })
        } else {
          this.cachedProperties[propIndex].pivot.value = newValue
        }

        this.$emit('input', { ...this.value, properties: this.cachedProperties })
      },
    },
  }
</script>
