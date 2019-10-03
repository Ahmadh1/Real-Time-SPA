<template>
	<div class="mb-5">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <router-link to="/" class="navbar-brand">SPA Forum</router-link>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav navbar-right">
		      <li class="nav-item" v-for="item in items">
		      	<router-link 
		      	:key="item.title" 
		      	:to="item.to"
		      	v-if="item.show" 
		      	class="nav-link">
		      	{{ item.title }}
		      </router-link>
		      </li>
		      <!-- notification goes here -->
				<notify v-if="loggedIn"></notify>
		    </ul>
		  </div>
		</nav>
</div>
</template>

<script>
import notify from './Notify'
	export default {
		data() {
			return {
				loggedIn: User.loggedIn(),
				items: [
					{title: 'Forum', to: '/forum', show: true},
					{title: 'Ask Question', to: '/create', show: User.loggedIn()},
					{title: 'Category', to: '/category', show: User.admin()},
					{title: 'Login', to: '/login', show: !User.loggedIn()},
					{title: 'Logout', to: '/logout', show: User.loggedIn()}
				]
			}
		},
		components: {notify},
		created() {
			EventBus.$on('logout', () =>{
				 User.logout();
			})
		}
	}
</script>