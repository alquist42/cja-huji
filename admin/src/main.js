// =========================================================
// * Vuetify Material Dashboard - v2.1.0
// =========================================================
//
// * Product Page: https://www.creative-tim.com/product/vuetify-material-dashboard
// * Copyright 2019 Creative Tim (https://www.creative-tim.com)
//
// * Coded by Creative Tim
//
// =========================================================
//
// * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

import App from './App.vue'
import router from './router'
import store from './store'
import './plugins/base'
// import './plugins/chartist'
// import './plugins/vee-validate'
import vuetify from './plugins/vuetify'
import axios from 'axios'
import VueExcelEditor from 'vue-excel-editor'
import VueTreeList from 'vue-tree-list'
import FileManager from 'laravel-file-manager'
import InstantSearch from 'vue-instantsearch'
import { TiptapVuetifyPlugin } from 'tiptap-vuetify'
// don't forget to import CSS styles
import 'tiptap-vuetify/dist/main.css'

window.Vue = require('vue')
/* global Vue */
Vue.prototype.$http = axios.create({
  baseURL: '/api',
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
  },
})

Vue.use(VueExcelEditor)
Vue.use(VueTreeList)
Vue.use(FileManager, { store })
Vue.use(InstantSearch)
Vue.use(TiptapVuetifyPlugin, {
  // the next line is important! You need to provide the Vuetify IObject to this place.
  vuetify, // same as "vuetify: vuetify"
  // optional, default to 'md' (default vuetify icons before v2.0.0)
  iconsGroup: 'mdi',
})

Vue.config.productionTip = false

// const files = require.context('./pages', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').slice(-1)[0].split('.')[0], () => files(key).default))

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App),
}).$mount('#app')

Vue.component('MediaManagerModal', require('./components/MediaManagerModal.vue').default)
Vue.component('MetadataEditorDrawer', require('./components/MetadataEditorDrawer').default)
Vue.component('VDialog', require('vuetify/lib/components/VDialog').default)
require('../../resources/assets/vendor/MediaManager/js/manager')
/* global EventHub */

new Vue({
  vuetify,
  data: () => ({
    mediaManager: false,
    mediaManagerDialog: false,
    itemId: null,
  }),
  created () {
    EventHub.listen('MediaManagerModal-modal-hide', () => { this.mediaManagerDialog = false })
    EventHub.listen('hide-media-manager', this.hideMediaManager)
    EventHub.listen('show-media-manager', this.showMediaManager)
    EventHub.listen('show-media-manager-dialog', this.showMediaManagerDialog)
  },
  beforeDestroy () {
    EventHub.removeListenersFrom([
      'MediaManagerModal-modal-hide',
      'hide-media-manager',
      'show-media-manager',
      'show-media-manager-dialog',
    ])
  },
  methods: {
    hideMediaManager () {
      this.mediaManager = false
    },

    showMediaManager () {
      this.mediaManager = true
    },

    showMediaManagerDialog (itemId) {
      this.itemId = itemId
      this.mediaManagerDialog = true
      this.$nextTick(() => EventHub.fire('MediaManagerModal-show'))
    },
  },
}).$mount('#laravel-media-manager')
