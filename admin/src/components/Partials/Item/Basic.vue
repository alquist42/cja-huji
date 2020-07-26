<template>
  <base-material-card class="px-5 py-3">
    <select-item-modal
      :exclude="value.id"
      v-model="copyAttributesFromObjectDialog"
      title="Select object to copy attributes from"
      @selected="copyAttributesFrom"
    />

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
          <v-tooltip left>
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
            <span>Copy all attributes from object</span>
          </v-tooltip>
          <!--<slot />-->
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
          :disabled="disabled"
          label="Name"
          required
          outlined
          @input="update('name', $event)"
        />

        <v-text-field
          :value="value.ntl"
          :disabled="disabled"
          label="NTL"
          required
          outlined
          @input="update('ntl', $event)"
        />

        <span>Description</span>
        <tiptap-vuetify
          :value="value.description"
          :disabled="disabled"
          :extensions="extensions"
          @input="update('description', $event)"
        />
      </v-form>

      <v-textarea
        :value="value.remarks"
        :disabled="disabled"
        label="Remarks"
        outlined
        counter="200"
        no-resize
        @input="update('remarks', $event)"
      />
    </v-card-text>
  </base-material-card>
</template>

<script>
  import { TiptapVuetify, Heading, Bold, Italic, Strike, Underline, Code, Paragraph, BulletList, OrderedList, ListItem, Link, Blockquote, HardBreak, HorizontalRule, History } from 'tiptap-vuetify'

  export default {
    name: 'ItemBasic',

    components: {
      TiptapVuetify,
      SelectItemModal: () => import('../../../components/SelectItemModal'),
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
      copyAttributesFromObjectDialog: false,
      isCopyingAttributes: false,
    }),

    watch: {
      isCopyingAttributes (val) {
        this.$emit('is-copying-attributes:update', val)
      },
    },

    methods: {
      async copyAttributesFrom (itemId) {
        this.copyAttributesFromObjectDialog = false
        this.isCopyingAttributes = true
        try {
          const { data } = await this.$http.get(`items/${itemId}?project=catalogue`)

          const keepOriginal = [
            'id',
            'old_id',
            'parent_id',
            'images',
            'children',
            'ancestors',
            'descendants',
            'leaf',
          ]
          const item = { ...this.value }
          Object.keys(item).forEach(field => {
            if (!keepOriginal.includes(field)) {
              item[field] = data[field]
            }
          })

          this.$emit('attributes-copied', item)
        } catch (e) {
          this.$emit('error')
          console.log(e)
        } finally {
          this.isCopyingAttributes = false
        }
      },

      update (key, value) {
        this.$emit('input', { ...this.value, [key]: value })
      },
    },
  }
</script>
