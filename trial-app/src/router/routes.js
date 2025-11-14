const routes = [
  {
    path: '/',
    component: () => import('layouts/principal.vue'),
    children: [
      { 
        path: '', component: () => import('pages/home/index.vue') 
      },
      { 
        path: '/dashboard', component: () => import('pages/dashboard/index.vue') 
      },
      { 
        path: '/users', component: () => import('pages/users/index.vue') 
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
  { path: "/login", component: () => import("layouts/login.vue") }

]

export default routes
