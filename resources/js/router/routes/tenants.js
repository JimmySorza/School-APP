import tenants from "../../views/tenants/tenants.vue"
import RegisterSchool from "../../views/schools/RegisterSchool"
export default [
    {
        component: tenants,
        name: 'TenantsView',
        path: '/tenants',
        meta: {
            requiresAuth: true,
        }
    },
    {
        component: RegisterSchool,
        name: 'RegisterSchoolView',
        path: '/registerschool',
        meta: {
            requiresAuth: true,
        },
        props: (route) => ({
            ...route.params
        })
    },
]