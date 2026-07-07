import { createRouter, createWebHistory } from 'vue-router'
import Landing from '../views/Landing.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Dashboard from '../views/Dashboard.vue'
import Tasks from '../views/Tasks.vue'
import CreateTask from '../views/CreateTask.vue'
import CreateCategories from '../views/CreateCategories.vue'
import DashboardLayout from '../components/layout/DashboardLayout.vue'
import EditTask from '../views/EditTask.vue'
import Categories from '../views/Categories.vue'
import EditCategories from '../views/EditCategories.vue'
const router = createRouter({
  history: createWebHistory(),
  routes:[
  {
    path: '/',
    name: 'Landing',
    component: Landing
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/Register',
    name: 'Register',
    component: Register
  },
  {
     path:'/',
     component:DashboardLayout,
children:[

{
path: 'dashboard',
name: 'Dashboard',
component: Dashboard,
meta: { requiresAuth: true }
},
{
path: 'tasks',
name: 'Tasks',
component: Tasks
},
{
path:'tasks/create',
name:'CreateTask',
component: CreateTask
},
{
    path:'tasks/edit/:id',
    name:'EditTask',
    component:EditTask
},
{
path: 'categories',
name: 'Categories',
component: Categories
},
{
path:'categories/create',
name:'CreateCategories',
component: CreateCategories
},

{
    path:'categories/edit/:id',
    name:'EditCategories',
    component: EditCategories
}

]}
]
})




export default router