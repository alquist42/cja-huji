import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: '/staff',
  routes: [
    {
      path: '/',
      name: 'Dashboard',
      component: () => import('@/views/Dashboard'),
    },
    {
      path: '/items/:id',
      name: 'Item',
      props: true,
      component: () => import('@/views/Item'),
    },
    // {
    //   path: '/',
    //   component: () => import('@/views/dashboard/Index'),
    //   children: [
    //     // Dashboard
    //     {
    //       name: 'Dashboard',
    //       path: '',
    //       component: () => import('@/views/dashboard/Dashboard'),
    //     },
    //     // Pages
    //     {
    //       name: 'User Profile',
    //       path: 'pages/user',
    //       component: () => import('@/views/dashboard/pages/UserProfile'),
    //     },
    //     {
    //       name: 'Notifications',
    //       path: 'components/notifications',
    //       component: () => import('@/views/dashboard/component/Notifications'),
    //     },
    //     {
    //       name: 'Icons',
    //       path: 'components/icons',
    //       component: () => import('@/views/dashboard/component/Icons'),
    //     },
    //     {
    //       name: 'Typography',
    //       path: 'components/typography',
    //       component: () => import('@/views/dashboard/component/Typography'),
    //     },
    //     // Tables
    //     {
    //       name: 'Regular Tables',
    //       path: 'tables/regular-tables',
    //       component: () => import('@/views/dashboard/tables/RegularTables'),
    //     },
    //     // Maps
    //     {
    //       name: 'Google Maps',
    //       path: 'maps/google-maps',
    //       component: () => import('@/views/dashboard/maps/GoogleMaps'),
    //     },
    //     // Upgrade
    //     {
    //       name: 'Upgrade',
    //       path: 'upgrade',
    //       component: () => import('@/views/dashboard/Upgrade'),
    //     },
    //   ],
    // },
  ],
})
