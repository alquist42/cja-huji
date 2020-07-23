<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <v-row no-gutters>
        <v-col class="flex-grow-1 display-2 font-weight-light">
          Images: {{ images.length }}
        </v-col>
        <v-col
          cols="auto"
          class="d-flex align-center"
        >
          <slot />
        </v-col>
      </v-row>
    </template>
    <v-card-text>
      <v-carousel height="250">
        <v-carousel-item
          v-for="image in images"
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
</template>

<script>
  export default {
    name: 'ItemImages',

    props: {
      images: {
        type: Array,
        required: true,
      },
    },

    methods: {
      update (key, value) {
        this.$emit('input', { ...this.value, [key]: value })
      },
    },
  }
</script>
