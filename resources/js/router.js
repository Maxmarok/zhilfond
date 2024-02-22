import { createWebHistory, createRouter, } from "vue-router"
import Catalog from '@/pages/Catalog.vue'
import Cart from '@/pages/Cart.vue'
import Dashboard from '@/pages/Dashboard.vue'
import Login from '@/pages/Login.vue'
import auth from '@/middleware/auth'
import middlewarePipeline from "@/middleware/middleware-pipeline"


const routes = [
    { path: '/', component: Catalog },
    { path: '/cart', component: Cart },

    { 
        path: '/dashboard', 
        component: Dashboard, 
        name: 'Dashboard', 
        meta: {
            middleware: auth
        },
    },

    { 
        path: '/login', 
        component: Login,
        name: 'Login',
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {

    if (!to.meta.middleware) {
        return next()
    }
    
    const middleware = Array.isArray(to.meta.middleware)
    ? to.meta.middleware
    : [to.meta.middleware];

    const context = {
        to,
        from,
        next,
    };

    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1),
    });
})


export default router
