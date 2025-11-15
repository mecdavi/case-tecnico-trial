const routes = [
  {
    path: '/',
    component: () => import('layouts/principal.vue'),
    children: [
      { 
        path: '', component: () => import('pages/dashboard/index.vue') 
      },
      { 
        path: '/users', component: () => import('pages/users/index.vue') 
      },
      { 
        path: '/users/edit/:id', component: () => import('pages/users/show.vue'),
        meta: { fdisable: false, nome: "usersEdit" }
      },
      { 
        path: '/users/edit', component: () => import('pages/users/show.vue'),
        meta: { fdisable: false, nome: "usersEdit" }
      },
      { 
        path: '/users/show/:id', component: () => import('pages/users/show.vue'),
        meta: { fdisable: true, nome: "usersShow" }
      },
    ],
  },
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
  { path: "/login", component: () => import("layouts/login.vue") }

]

export default routes
