<template>
	<div class="mb-5">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <router-link to="/home" class="navbar-brand">SPA Forum</router-link>
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
		      <!-- <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		           <i class="far fa-bell"></i>
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		          <a class="dropdown-item" href="#">Action</a>
		          <a class="dropdown-item" href="#">Another action</a>
		          <div class="dropdown-divider"></div>
		          <a class="dropdown-item" href="#">Something else here</a>
		        </div>
		      </li> -->
		    </ul>
		  </div>
		</nav>
</div>
</template>

<script>
	export default {
		data() {
			return {
				items: [
					{title: 'Forum', to: '/home', show: true},
					{title: 'Ask Question', to: '/create', show: User.loggedIn()},
					{title: 'Category', to: '/category', show: User.admin()},
					{title: 'Login', to: '/login', show: !User.loggedIn()},
					{title: 'Logout', to: '/logout', show: User.loggedIn()}
				]
			}
		},
		created() {
			EventBus.$on('logout', () =>{
				 User.logout();
			})
		}
	}
</script>