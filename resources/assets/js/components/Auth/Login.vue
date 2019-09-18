<template>
	<div class="row mt-5 mb-5">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 offset-2">
			<div class="card">
				<div class="card-header">Login</div>
				<div class="card-body">
					<form @submit.prevent="login">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" id="email" v-model="form.email" class="form-control" placeholder="Enter Email" autofocus>
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" id="password" v-model="form.password" class="form-control" placeholder="Enter Password">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-outline-success form-control">Login</button>
							<p class="mt-2">Don't have an account click<router-link to="/signup" class="text-danger">&nbsp;here...</router-link></p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				form:{
					email: null,
					password: null
				}
			}
		},
		created() {
			if (User.loggedIn()) {
				this.$router.push({name:'index'})
			}
		},
		methods: {
			login() {
				User.login(this.form)
			}
		}
	}
</script>