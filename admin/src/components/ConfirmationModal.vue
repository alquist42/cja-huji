<template>
  <v-dialog
    v-model="dialog"
    max-width="800"
    persistent
  >
    <v-card class="px-5 py-3">
      <div class="headline font-weight-light">
        {{ title }}
      </div>
      <v-card-text>
        <span class="body-1">{{ message }}</span>
      </v-card-text>
      <v-card-actions>
        <v-btn
          text
          color="warning"
          @click="closeDialog"
        >
          {{ btnCancelText }}
        </v-btn>
        <v-btn
          text
          color="primary"
          @click="confirm"
        >
          {{ btnConfirmText }}
        </v-btn>
      </v-card-actions>
    </v-card>
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

      btnCancelText: {
        type: String,
        default: 'Cancel',
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
