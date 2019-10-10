import Browse from './pages/Browse.vue';
import VueRouter from 'vue-router';

const routes = {
  routes: [
    {
      path: '/',
      component: Browse,
      name: 'browse'
    }
  ]
};

const router = new VueRouter(routes)

// // Route 'project' dynamic base hotfix
// if (router.mode === 'history') {
//   router.history.getCurrentLocation = function() {
//     let path = window.location.pathname
//     let base = router.history.base
//
//     let project = path.split(base).shift()
//
//     router.project = project
//     base = project + base
//
//     // Removes base from path (case-insensitive)
//     if (base && path.toLowerCase().indexOf(base.toLowerCase()) === 0) {
//       path = path.slice(base.length)
//     }
//
//     return (path || '/') + window.location.search + window.location.hash
//   }
// }

export default router
