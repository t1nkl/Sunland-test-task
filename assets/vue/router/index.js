import { createRouter, createWebHistory } from 'vue-router'
import ElementorView from '../layouts/ElementorView.vue'
import LoginView from '../views/LoginView.vue'

const router = createRouter({
  mode: "history",
  history: createWebHistory('/'),
  routes: [
    {
      path: '/',
      name: 'elementor_template',
      component: ElementorView,
      children: [
        {
          path: '/',
          name: 'base',
          component: () => import('../views/BaseView.vue')
        },
        {
          path: '/login',
          name: 'login',
          component: LoginView
        },
        {
          path: '/dashboard',
          name: 'dashboard',
          meta: { requiresAuth: true },
          component: () => import('../views/DashboardView.vue')
        },
      ]
    },
    { path: '/:pathMatch(.*)*', redirect: "/" }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (localStorage.getItem("token")) {
      next();
    } else {
      next({
        path: "/login",
        query: { redirect: to.fullPath }
      });
    }
  } else {
    next(); // make sure to always call next()!
  }
});

export default router
