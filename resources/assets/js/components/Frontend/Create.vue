<template>
	<div class="row">
		<div class="col-8 offset-2 mb-5">
			<div class="card">
				<div class="card-header">Ask Question</div>
				<div class="card-body">
					<form @submit.prevent="ask">
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" id="title" class="form-control" v-model="form.title" placeholder="Gibbrey droo droo">
							<span class="text-danger" v-if="errors.title">{{ errors.title[0] }}</span>
						</div>
						<div class="form-group">
							<label for="category">Select Category:</label>
							<select class="form-control" id="category" v-model="form.category_id">
								<option v-for="cat in categories" :value="cat.id">{{ cat.title }}</option>
							</select>
						</div>
						<div class="form-group">
							<label for="body">Description:</label>
							<vue-simplemde v-model="form.body" />
							<span class="text-danger" v-if="errors.body">{{ errors.body[0] }}</span>
						</div>
						<div class="form-group">
							<button :disabled="disabled" class="btn btn-success form-control">Ask Question</button>
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
				title: null,
				body: null,
				category_id: null
			},
			categories: {},
			errors: {}
		}
	},
	computed: {
		disabled() {
			return !(this.form.title && this.form.body && this.form.category_id)
		}
	},
	created() {
		axios.get('/api/category')
			.then((res) => {
				this.categories = res.data.data
			})
	},
	methods: {
		ask() {
			axios.post('/api/question', this.form)
				.then((res) => {
					// console.log(res.data.data)
					this.$router.push(res.data.path)
				})
				.catch((err) => {
					this.errors = err.response.data.errors
				})
		}
	}
}
</script>