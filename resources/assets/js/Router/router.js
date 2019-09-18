import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import login from '../components/Auth/Login'
import signup from '../components/Auth/Signup'
import logout from '../components/Auth/Logout'
import index from '../components/Frontend/Forum'
import read from '../components/Frontend/Read'
import create from '../components/Frontend/Create'

const routes = [
  { path: '/login', component: login, name: 'login' },
  { path: '/signup', component: signup, name: 'signup' },
  { path: '/logout', component: logout, name: 'logout' },
  { path: '/index', component: index, name: 'index' },
  { path: '/question/:slug', component: read, name: 'read' },
  { path: '/create', component: create, name: 'create' }

]
const router = new VueRouter({
  routes, // short for `routes: routes`
  mode: 'history'
})

export default router