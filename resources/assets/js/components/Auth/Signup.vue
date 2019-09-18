<template>
<div class="row mt-5 mb-5">
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 offset-2">
		<div class="card">
			<div class="card-header">Signup</div>
			<div class="card-body">
				<form class="form-horizontal" role="form" @submit.prevent="signup">
					<div class="form-group">
						<label for="name">Name:</label>
						<input type="text" id="name" v-model="form.name" class="form-control" placeholder="Enter Name" autofocus>
						<span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" id="email" v-model="form.email" class="form-control" placeholder="Enter Email" autofocus>
						<span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" id="password" v-model="form.password" class="form-control" placeholder="Enter Password">
						<span class="text-danger" v-if="errors.password">{{ errors.password[0] }}</span>
					</div>
					<div class="form-group">
						<label for="cnf_password">Confirm Password:</label>
						<input type="password" id="cnf_password" v-model="form.password_confirmation" class="form-control" placeholder="Confirm Password">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-outline-danger form-control">Signup</button>
						<p class="mt-2">Already have an account click<router-link to="/login" class="text-success">&nbsp;here...</router-link></p>
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
				form: {
					name: null,
					email: null,
					password: null,
					password_confirmation: null
				},
				errors: {}
			}
		},
		created() {
			if (User.loggedIn()) {
				this.$router.push({name:'index'})
			}
		},
		methods: {
			signup() {
				// alert('working')		
				axios.post('/api/auth/signup', this.form)
					.then(res => {
						User.resAfterLogin(res)
						this.$router.push({name:'index'})
					})
					.catch(err => {
						this.errors = err.response.data.errors
					})
			}
		}
	}
</script>