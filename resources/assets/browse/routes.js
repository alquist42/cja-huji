import Browse from './pages/Browse.vue';
import VueRouter from 'vue-router';

window.project = document.getElementById('app').dataset.project;
const BASE_URL = document.getElementById('app').dataset.url;

const routes = {
  mode: 'history',
  base: `/${BASE_URL}/browse`,
  routes: [
    {
      path: '/',
      component: Browse,
      name: 'browse'
    },
    {
      path: '/:type',
      component: Browse,
      name: 'browse-root'
    },
    {
      path: '/:type/:id',
      component: Browse,
      name: 'browse-id'
    }
  ]
};

const router = new VueRouter(routes)

export default router
