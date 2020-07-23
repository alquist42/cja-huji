<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <div class="display-2 font-weight-light">
        Map
      </div>
    </template>
    <v-card-text>
      <v-text-field
        v-model="value.geo_lat"
        label="Latitude"
        type="number"
        outlined
        :disabled="disabled"
        @input="update('geo_lat', $event)"
      />
      <v-text-field
        v-model="value.geo_lng"
        label="Longitude"
        type="number"
        outlined
        :disabled="disabled"
        @input="update('geo_lng', $event)"
      />
      <v-text-field
        v-model="value.geo_options"
        label="Geolocation options"
        outlined
        :disabled="disabled"
        @input="update('geo_options', $event)"
      />
    </v-card-text>
  </base-material-card>
</template>

<script>
  export default {
    name: 'ItemMap',

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

    methods: {
      update (key, value) {
        const item = { ...this.value, [key]: value }

        this.$emit('input', item)
      },
    },
  }
</script>
