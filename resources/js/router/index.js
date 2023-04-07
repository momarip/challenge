import {createRouter, createWebHistory } from 'vue-router';
import homeAdminIndex from '../components/admin/index.vue';
import homePageIndex from '../components/pages/home/index.vue';
import adminCompanyIndex from '../components/admin/company/index.vue';
import adminEmployeeIndex from '../components/admin/employee/index.vue';
import notFound from '../components/NotFound.vue';
import login from '../components/auth/login.vue';

const routes = [
    //admin
    {
        path: '/admin',
        name: 'adminDash',
        component: homeAdminIndex,
        meta:{
            requiresAuth: true
        }
    },
    //page
    {
        path: '/',
        nale: 'Home',
        component: homePageIndex,
        meta:{
            requiresAuth: false
        }
    },
    //Notfound
    {
        path: '/:pathMatch(.*)*',
        name: 'notFound',
        component: notFound,
        meta:{
            requiresAuth: false
        }
    },
    // login
    {
        path: '/login',
        name: 'Login',
        component: login,
        meta:{
            requiresAuth: false
        }
    },
    {
        path: '/admin/company',
        name: 'adminCompany',
        component: adminCompanyIndex,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/admin/employee',
        name: 'adminEmployee',
        component: adminEmployeeIndex,
        meta: {
            requiresAuth: true
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from)=>{
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
        return { name: 'Login'}
    }

    if(to.meta.requiresAuth == false && localStorage.getItem('token')){
        return { name: 'adminDash'}
    }
})

export default router;