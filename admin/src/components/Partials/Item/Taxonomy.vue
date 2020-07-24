<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <div class="display-2 font-weight-light">
        Taxonomy
      </div>
    </template>
    <v-card-text>
      <item-taxon
        v-for="taxonName in taxons"
        :key="taxonName"
        :value="value"
        :name="taxonName"
        :disabled="disabled"
        @input="update"
      />

      <item-makers
        :value="value"
        :disabled="disabled"
        @input="update"
      />
    </v-card-text>
  </base-material-card>
</template>

<script>
  export default {
    name: 'ItemTaxonomy',

    components: {
      ItemMakers: () => import('./Makers'),
      ItemTaxon: () => import('./Taxon'),
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
    }),

    methods: {
      update (item) {
        this.$emit('input', item)
      },
    },
  }
</script>
