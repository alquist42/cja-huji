<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <div class="display-2 font-weight-light">
        Item's Composition
      </div>
    </template>
    <v-card-text>
      <v-treeview
        open-on-click
        :active="compositionTreeActive"
        :open="compositionTreeOpen"
        :items="leaf"
      >
        <template #append="{ item: treeItem }">
          <router-link
            v-if="value.id !== treeItem.id"
            :to="{ name: 'Item', params: { id: treeItem.id } }"
            @click.prevent
          >
            <v-icon>mdi-arrow-right-bold-box</v-icon>
          </router-link>
        </template>
      </v-treeview>
    </v-card-text>
  </base-material-card>
</template>

<script>
  export default {
    name: 'Composition',

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
      compositionTreeActive () {
        return this.value.leaf.length ? [this.value.id] : []
      },

      compositionTreeOpen () {
        return this.value.ancestors.map(item => item.id).concat([this.value.id])
      },

      leaf () {
        return this.value.leaf
      },
    },
  }
</script>
