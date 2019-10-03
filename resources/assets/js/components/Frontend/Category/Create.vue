<template>
	<div>
	<div class="row mt-5 mb-5">
		<div class="col-8 offset-2">
			<div class="alert alert-danger" v-if="errors">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ errors.title[0] }}
			</div>
			<div class="card">
				<div class="card-header">Add new Category</div>
				<div class="card-body">
					<form @submit.prevent="submit">
						<div class="form-group">
							<label for="title">Title:</label>
							<input type="text" id="title" v-model="form.title" class="form-control">
						</div>
						<div class="form-group">
							<button :disabled="disabled" class="btn btn-primary form-control" type="submit" v-if="editSlug">Update</button>
							<button class="btn btn-danger form-control" :disabled="disabled" type="submit" v-else>Create</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-5 mb-5">
		<div class="col-8 offset-2">
			<div class="card">
				<div class="card-header">All Categories</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Title</th>
								<th>Added on</th>
								<th>Edit</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(cat, index) in categories" :key="cat.id">
								<td>{{ cat.title }}</td>
								<td>{{ cat.created_at }}</td>
								<td>
									<button class="btn btn-dark btn-sm" @click="edit(index)"><i class="fa fa-pen"></i></button></td>
								<td>
									<button class="btn btn-danger btn-sm" @click="destroy(cat.slug, index)"><i class="fa fa-trash"></i></button></td>
							</tr>
						</tbody>
					</table>
				</div>
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
    		title:null
    	},
    	categories: {},
    	editSlug: null,
    	errors: null
    }
  },

  created () {
  	axios.get('/api/category')
  		.then((res) => {
  			this.categories = res.data.data
  		})
  },
  computed: {
		disabled() {
			// return !(this.form.title)
		}
	},
  methods: {
  	submit() {
  		this.editSlug ? this.update() : this.create()
	},
	create() {
		axios.post('/api/category', this.form)
  			.then((res) => {
  				this.categories.unshift(res.data)
  				this.form.title = null
  			})
  			.catch((err) => {
  				this.errors = err.response.data.errors
  			})
	},
	update() {
		axios.patch(`/api/category/${this.editSlug}`, this.form)
  			.then((res) => {
  				this.categories.unshift(res.data)
  				this.form.title = null
  			})	
	},
	edit(index) {
		this.form.title = this.categories[index].title
		this.editSlug = this.categories[index].slug
		this.categories.splice(index, 1)
	},
	destroy(slug, index) {
		axios.delete(`/api/category/${slug}`)
			.then((res) => {
				this.categories.splice(index,1)
			})
	}
  }
}
</script>