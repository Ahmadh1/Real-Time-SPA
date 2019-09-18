<template>
	<div class="card">
		<div class="card-header">Update Question</div>
		<div class="card-body">
			<form @submit.prevent="update">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" id="title" class="form-control" v-model="form.title">
				</div>
				<div class="form-group">
					<label for="body">Description:</label>
					<textarea v-model="form.body" id="body" rows="5" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-outline-primary" type="submit">Update</button>
					<button class="btn btn-outline-danger" @click="cancel">Cancel</button>
				</div>
			</form>	
		</div>
	</div>
</template>

<script>
export default {
	props: ['question'],
	data() {
		return {
			form: {
				title: null,
				body: null
			}
		}
	},
	methods: {
		cancel() {
			EventBus.$emit('cancelEditing')
		},

		update() {
			axios.patch(`/api/question/${this.question.slug}`, this.form)
				.then((res) => {
					this.cancel()
				})
		}
	},
	created() {
		this.form = this.question
	}
}
</script>