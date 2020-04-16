import Vue from 'vue'
import VueRouter from 'vue-router'

import Middlewares from '../middlewares/index'
import AuthLayout from '../views/layouts/AuthLayout.vue'
import AppLayout from '../views/layouts/AppLayout.vue'
import ax from '../axios'

Vue.use(VueRouter)


const routes = [
    {
        path: '/',
        component: AuthLayout,
        children: [
            {
                path: 'login',
                name: 'login',
                component: () => import('../views/auth/Login.vue'),
                meta: {
                    middleware: [Middlewares.guest]
                }
            },
            {
                path: 'register',
                name: 'register',
                component: () => import('../views/auth/Register.vue'),
                meta: {
                    middleware: [Middlewares.guest]
                }
            },
            {
                path: 'forgot-password',
                name: 'forgotPassword',
                component: () => import('../views/auth/ForgotPassword.vue')
            },
        
            {
                path: 'reset-password',
                name: 'resetPassword',
                component: () => import('../views/auth/ResetPassword.vue')
            }
        ]
    },

    {
        path: '/',
        component: AppLayout,
        children: [
            {
                path: '/dashboard',
                name: 'dashboard',
                component: () => import('../views/pages/Dashboard.vue'),
                meta: {
                    middleware: [Middlewares.auth]
                }
            },

            {
                path: 'dashboard/roles',
                name: 'roles',
                component: () => import('../views/pages/RolesComponent.vue'),
                meta: {
                    middleware: [Middlewares.auth]
                }
            }
        ]
    }
]


const router = new VueRouter({
    mode: 'history',
    routes
});


router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token') || null
    ax.defaults.headers['Authorization'] = `Bearer ${token}`;
    next();
});


function nextCheck(context, middleware, index){
    const nextMiddleware = middleware[index];

    if(!nextMiddleware) return context.next;

    return (...parameters) => {
        context.next(...parameters);
        const nextMidd = nextCheck(context, middleware, index + 1);

        nextMiddleware({...context, next: nextMidd})
    }
}

router.beforeEach((to, from, next) => {
    if(to.meta.middleware){
        const middleware = Array.isArray(to.meta.middleware) ? to.meta.middleware : [to.meta.middleware];

        const ctx = {
            from,
            next,
            router,
            to
        };

        const nextMiddleware = nextCheck(ctx, middleware, 1);

        return middleware[0]({...ctx, next: nextMiddleware});
    }

    return next();
});



export default router