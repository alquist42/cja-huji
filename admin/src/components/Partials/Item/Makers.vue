<template>
  <v-row
    no-gutters
    class="mb-2"
  >
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
      <span class="overline">Makers</span>
      <span
        v-if="inheritance === 'enabled'"
        class="caption"
      >
        (inherited)
      </span>
      <taxon-maker-modal
        :disabled="disabled"
        @input="addMaker"
      />
    </v-col>
    <v-col cols="12">
      <template v-if="inheritance === 'disabled-own'">
        <v-chip
          v-for="maker in value.makers"
          :key="maker.id"
          class="mb-1 mr-1"
          close
          color="green lighten-2"
          :disabled="disabled"
          @click:close="removeMaker(maker.id)"
        >
          {{ maker.artist.name }} ({{ maker.profession.name }})
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
            v-for="maker in ancestorsTaxonomy"
            :key="maker.id"
            class="mb-1 mr-1"
            :disabled="disabled"
          >
            {{ maker.artist.name }} ({{ maker.profession.name }})
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
  export default {
    name: 'ItemMakers',

    components: {
      TaxonMakerModal: () => import('../../../components/TaxonMakerModal'),
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

    computed: {
      hasParent () {
        return this.value.ancestors.length
      },

      inheritance () {
        const makers = this.value.makers

        if (!makers || makers.length === 0) {
          return 'enabled' // blank - inheritance enabled
        } else if (makers[0].id === -1) {
          return 'disabled-none' // -1 (unknown) - inheritance disabled - but show nothing
        } else {
          return 'disabled-own' // other own value - inheritance disabled
        }
      },

      ancestorsTaxonomy () {
        for (const ancestor of this.value.ancestors) {
          if (ancestor.makers.length) {
            if (ancestor.makers[0].id !== -1) {
              return ancestor.makers
            }
          }
        }

        return []
      },

      details () {
        return this.value.maker_details[0] && this.value.maker_details[0].details
      },
    },

    methods: {
      toggleInheritance () {
        if (this.inheritance === 'enabled') {
          this.$emit('input', { ...this.value, makers: [{ id: -1, name: 'unknown' }] })
        } else {
          this.$emit('input', { ...this.value, makers: [] })
        }
      },

      addMaker (maker) {
        const makers = this.value.makers.filter(maker => maker.id !== -1)
        makers.push(maker)

        this.$emit('input', { ...this.value, makers })
      },

      removeMaker (makerId) {
        const makers = this.value.makers.filter(maker => maker.id !== makerId)

        this.$emit('input', { ...this.value, makers })
      },
    },
  }
</script>
