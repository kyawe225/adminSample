import { RouteRecordRaw } from 'vue-router';
import EmployeeIndexVue from './pages/admin/Employee/EmployeeIndex.vue';
import EmployeeCreateVue from './pages/admin/Employee/EmployeeCreate.vue';
import EmployeeUpdateVue from './pages/admin/Employee/EmployeeUpdate.vue';
import CompanyIndexVue from './pages/admin/Company/CompanyIndex.vue';
import CompanyCreateVue from './pages/admin/Company/CompanyCreate.vue';
import CompanyUpdateVue from './pages/admin/Company/CompanyUpdate.vue';

const routes:RouteRecordRaw[]=[
    
    {
        path:'/employee',
        name:'employee',
        children:[
            {
                path:"",
                name:"employeeIndex",
                component:EmployeeIndexVue
            },
            {
                path:"create",
                name:"employeeCreate",
                component:EmployeeCreateVue
            },
            {
                path:"update/:id",
                name:"employeeUpdate",
                component:EmployeeUpdateVue
            }
        ]
    },
    {
        path:'/company',
        name:'company',
        children:[
            {
                path:"",
                name:"companyIndex",
                component:CompanyIndexVue
            },
            {
                path:"create",
                name:"companyCreate",
                component:CompanyCreateVue
            },
            {
                path:"update/:id",
                name:"companyUpdate",
                component:CompanyUpdateVue,
            }
        ]
    }
]

export default routes;