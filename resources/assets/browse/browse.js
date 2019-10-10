import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './routes';


Vue.use(VueRouter);

let app = new Vue({
  el: '#app',
  router
});
