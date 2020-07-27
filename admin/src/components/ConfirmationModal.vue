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
          color="error"
          @click="$emit('cancel')"
        >
          {{ btnCancelText }}
        </v-btn>
        <v-btn
          v-if="showNoButton"
          text
          color="warning"
          @click="$emit('no')"
        >
          {{ btnNoText }}
        </v-btn>
        <v-btn
          text
          color="primary"
          @click="$emit('yes')"
        >
          {{ btnYesText }}
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
        default: 'Please confirm action',
      },

      message: {
        type: String,
        default: 'Are you sure?',
      },

      btnCancelText: {
        type: String,
        default: 'Cancel',
      },

      btnNoText: {
        type: String,
        default: 'No',
      },

      btnYesText: {
        type: String,
        default: 'Yes',
      },

      showNoButton: {
        type: Boolean,
        default: true,
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
  }
</script>
