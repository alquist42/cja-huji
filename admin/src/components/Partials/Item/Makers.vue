<template>
  <v-row
    no-gutters
    class="mb-2"
  >
    <v-col
      cols="12"
      class="pb-0"
    >
      <span class="overline">Makers</span>
      <taxon-maker-modal
        :disabled="disabled"
        @input="addMaker"
      />
    </v-col>
    <v-col cols="12">
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
      details () {
        return this.value.maker_details[0] && this.value.maker_details[0].details
      },
    },

    methods: {
      addMaker (maker) {
        const makers = [...this.value.makers, maker]

        this.$emit('input', { ...this.value, makers })
      },

      removeMaker (makerId) {
        const makers = this.value.makers.filter(maker => maker.id !== makerId)

        this.$emit('input', { ...this.value, makers })
      },
    },
  }
</script>
