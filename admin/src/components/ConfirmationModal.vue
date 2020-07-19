<template>
  <v-dialog
    v-model="dialog"
    max-width="800"
    persistent
  >
    <base-material-card class="px-5 py-3">
      <template v-slot:heading>
        <div class="display-2 font-weight-light">
          {{ title }}
        </div>
      </template>
      <v-card-text>
        <span class="body-1">{{ message }}</span>
      </v-card-text>
      <v-card-actions>
        <v-btn
          text
          color="warning"
          @click="closeDialog"
        >
          Cancel
        </v-btn>
        <v-btn
          text
          color="primary"
          @click="confirm"
        >
          {{ btnConfirmText }}
        </v-btn>
      </v-card-actions>
    </base-material-card>
  </v-dialog>
</template>

<script>
  export default {
    name: 'ConfirmationModal',

    props: {
      value: {
        type: Boolean,
        required: true,
      },

      title: {
        type: String,
        default: 'Select item',
      },

      message: {
        type: String,
        default: 'Are you sure?',
      },

      btnConfirmText: {
        type: String,
        default: 'OK',
      },
    },

    data () {
      return {
        dialog: false,
      }
    },

    watch: {
      value: {
        immediate: true,
        handler (val) {
          this.dialog = val
        },
      },
    },

    methods: {
      closeDialog () {
        this.$emit('cancel')
      },

      confirm () {
        this.$emit('confirm')
      },
    },
  }
</script>
