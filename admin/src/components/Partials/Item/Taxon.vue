<template>
  <v-row
    no-gutters
    class="mb-2"
  >
    <select-item-modal
      v-model="copyAttributesFromObjectDialog"
      :exclude="value.id"
      title="Select item to copy subject from"
      @selected="copySubjects"
    />
    <v-col
      cols="12"
      class="pb-0"
    >
      <template v-if="hasParent">
        <v-tooltip top>
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              v-bind="attrs"
              icon
              :disabled="disabled"
              v-on="on"
              @click="toggleInheritance"
            >
              <v-icon color="grey">
                {{ inheritance === 'enabled' ? 'mdi-lock' : 'mdi-lock-open' }}
              </v-icon>
            </v-btn>
          </template>
          <span>{{ inheritance === 'enabled' ? 'Disable' : 'Enable' }} taxonomy inheritance</span>
        </v-tooltip>
      </template>
      <span class="overline">
        {{ name.replace('_', ' ') }}
      </span>
      <span
        v-if="inheritance === 'enabled'"
        class="caption"
      >
        (inherited)
      </span>
      <taxon-modal
        :taxon="name"
        :value="value[name] || []"
        :disabled="disabled"
        @input="updateTaxon"
      />
      <v-tooltip
        v-if="name === 'subjects'"
        right
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            v-bind="attrs"
            icon
            :loading="isCopyingAttributes"
            :disabled="disabled"
            v-on="on"
            @click="copyAttributesFromObjectDialog = true"
          >
            <v-icon>mdi-content-copy</v-icon>
          </v-btn>
        </template>
        <span>Copy Subject from item</span>
      </v-tooltip>
    </v-col>
    <v-col cols="12">
      <template v-if="inheritance === 'disabled-own'">
        <v-chip
          v-for="obj in value[name]"
          :key="obj.id"
          class="mb-1 mr-1"
          close
          color="green lighten-2"
          :disabled="disabled"
          @click:close="removeTaxonItem(obj.id)"
        >
          {{ obj.name }}
        </v-chip>
        ({{ details }})
      </template>
      <v-chip
        v-else-if="inheritance === 'disabled-none'"
        class="mb-1 mr-1"
        outlined
        disabled
      >
        none
      </v-chip>
      <template v-else-if="hasParent">
        <template v-if="ancestorsTaxonomy.length">
          <v-chip
            v-for="obj in ancestorsTaxonomy"
            :key="obj.id"
            class="mb-1 mr-1"
            :disabled="disabled"
          >
            {{ obj.name }}
          </v-chip>
          <!--({{ details }})-->
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
</template>

<script>
  import { singular } from 'pluralize'

  export default {
    name: 'ItemTaxon',

    components: {
      TaxonModal: () => import('../../../components/TaxonModal'),
      SelectItemModal: () => import('../../../components/SelectItemModal'),
    },

    props: {
      value: {
        type: Object,
        required: true,
      },

      name: {
        type: String,
        required: true,
      },

      disabled: {
        type: Boolean,
        default: false,
      },
    },

    data: () => ({
      copyAttributesFromObjectDialog: false,
      isCopyingAttributes: false,
    }),

    computed: {
      hasParent () {
        return this.value.ancestors.length
      },

      inheritance () {
        const taxons = this.value[this.name]

        if (!taxons || taxons.length === 0) {
          return 'enabled' // blank - inheritance enabled
        } else if (taxons[0].id === -1) {
          return 'disabled-none' // -1 (unknown) - inheritance disabled - but show nothing
        } else {
          return 'disabled-own' // other own value - inheritance disabled
        }
      },

      ancestorsTaxonomy () {
        for (const ancestor of this.value.ancestors) {
          if (ancestor[this.name].length) {
            if (ancestor[this.name][0].id !== -1) {
              return ancestor[this.name]
            }
          }
        }

        return []
      },

      details () {
        const field = `${singular(this.name)}_details`

        return this.value[field] && this.value[field][0] && this.value[field][0].details
      },
    },

    methods: {
      toggleInheritance () {
        if (this.inheritance === 'enabled') {
          this.$emit('input', { ...this.value, [this.name]: [{ id: -1, name: 'unknown' }] })
        } else {
          this.$emit('input', { ...this.value, [this.name]: [] })
        }
      },

      updateTaxon (taxonItems) {
        this.$emit('input', { ...this.value, [this.name]: taxonItems })
      },

      removeTaxonItem (taxonId) {
        const taxonItems = this.value[this.name].filter(taxonItem => taxonItem.id !== taxonId)

        this.$emit('input', { ...this.value, [this.name]: taxonItems })
      },

      async copySubjects (itemId) {
        this.copyAttributesFromObjectDialog = false
        this.isCopyingAttributes = true
        try {
          const { data } = await this.$http.get(`items/${itemId}?project=catalogue`)

          this.updateTaxon(data[this.name])

          this.$emit('success', 'Subject copied')
        } catch (e) {
          this.$emit('error')
          console.log(e)
        } finally {
          this.isCopyingAttributes = false
        }
      },
    },
  }
</script>
