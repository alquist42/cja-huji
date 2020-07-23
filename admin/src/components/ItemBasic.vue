<template>
  <base-material-card class="px-5 py-3">
    <template v-slot:heading>
      <v-row no-gutters>
        <v-col class="flex-grow-1 display-2 font-weight-light">
          <span v-if="value.id">Item {{ value.id }}</span>
          <span v-else>New Item</span>
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
      <v-form
        ref="form"
        lazy-validation
      >
        <v-text-field
          :value="value.name"
          label="Name"
          required
          outlined
          @input="update('name', $event)"
        />

        <v-text-field
          :value="value.ntl"
          label="NTL"
          required
          outlined
          @input="update('ntl', $event)"
        />

        <span>Description</span>
        <tiptap-vuetify
          :value="value.description"
          :extensions="extensions"
          @input="update('description', $event)"
        />
      </v-form>
    </v-card-text>
  </base-material-card>
</template>

<script>
  import { TiptapVuetify, Heading, Bold, Italic, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'

  export default {
    name: 'ItemBasic',

    components: {
      TiptapVuetify,
    },

    props: {
      value: {
        type: Object,
        required: true,
      },
    },

    data: () => ({
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

    methods: {
      update (key, value) {
        this.$emit('input', { ...this.value, [key]: value })
      },
    },
  }
</script>
