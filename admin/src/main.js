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

// import App from './App.vue'
// import router from './router'
import store from './store'
import './plugins/base'
import './plugins/chartist'
import './plugins/vee-validate'
import vuetify from './plugins/vuetify'
// import i18n from './i18n'
import axios from 'axios'
import VueExcelEditor from 'vue-excel-editor'
import VueTreeList from 'vue-tree-list'
import FileManager from 'laravel-file-manager'
import InstantSearch from 'vue-instantsearch'
import Dash from './pages/dash'
import Items from './pages/items'
import Item from './pages/item'
import Media from './pages/media'
import MetadataEditorDrawer from './components/MetadataEditorDrawer'
import { TiptapVuetifyPlugin } from 'tiptap-vuetify'
// don't forget to import CSS styles
import 'tiptap-vuetify/dist/main.css'

window.Vue = require('vue')
/* global Vue */
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

const root = document.getElementById('app')

Vue.prototype.$http = axios
Vue.prototype.$http.defaults.headers.common['X-CSRF-TOKEN'] = root.dataset.csrfToken
Vue.prototype.$http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
Vue.prototype.$route = window.route

Vue.config.productionTip = false

const files = require.context('./pages', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').slice(-1)[0].split('.')[0], () => files(key).default))
Vue.component('Dash', Dash)
Vue.component('Items', Items)
Vue.component('Item', Item)
Vue.component('Media', Media)
Vue.component('MetadataEditorDrawer', MetadataEditorDrawer)

Vue.component('MediaManagerModal', require('./components/MediaManagerModal.vue').default)
require('../../resources/assets/vendor/MediaManager/js/manager')

new Vue({
  // router,
  store,
  vuetify,
  // i18n,
  // render: h => h(Vue.component(root.dataset.vueComponent), { props: JSON.parse(root.dataset.vueProps) }),
}).$mount(root)
