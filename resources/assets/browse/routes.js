import Browse from './pages/Browse.vue';
import VueRouter from 'vue-router';

window.project = document.getElementById('app').dataset.project

const routes = {
  mode: 'history',
  base: `/${window.project}/browse`,
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
