import Vue from 'vue';
import * as VueGoogleMaps from 'vue2-google-maps';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

import Map from './components/Map';

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyB4JwWo5VPt9WyNp3Ne2uc2FMGEePHpqJ8',
    // libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
  }
});

Vue.component('v-select', vSelect);

let app = new Vue({
  el: '#app',
  components: {
    'google-map': Map
  }
});
