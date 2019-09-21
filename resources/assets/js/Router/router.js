import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import login from '../components/Auth/Login'
import signup from '../components/Auth/Signup'
import logout from '../components/Auth/Logout'
import home from '../components/Frontend/Forum'
import read from '../components/Frontend/Read'
import create from '../components/Frontend/Create'
// category Routes
import createCategory from '../components/Frontend/Category/Create' 
const routes = [
  { path: '/login', component: login, name: 'login' },
  { path: '/signup', component: signup, name: 'signup' },
  { path: '/logout', component: logout, name: 'logout' },
  { path: '/home', component: home, name: 'home' },
  { path: '/question/:slug', component: read, name: 'read' },
  { path: '/create', component: create, name: 'create' },
  { path: '/category', component: createCategory, name: 'category' }

]
const router = new VueRouter({
  routes, // short for `routes: routes`
  mode: 'history'
})

export default router