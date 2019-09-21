<template>
	<div class="card mt-5">
		<div class="card-header">Contribute in this Thread</div>
		<div class="card-body">
			<form @submit.prevent="reply">
				<div class="form-group">
					<label for="reply">Reply:</label>
					<vue-simplemde v-model="body" id="reply" />
				</div>
				<div class="form-group">
					<button class="btn btn-outline-secondary form-control">Reply</button>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
export default {
	props: ['questionSlug'],
	data() {
		return {
			body: ''
		}
	},
	methods: {
		reply() {
			// alert('working')
			axios.post(`/api/question/${this.questionSlug}/reply`, {body: this.body})
				.then((res) => {
					this.body = ''
					EventBus.$emit('newReply', res.data.reply)
					window.scrollTo(0, 0)
				})
		}
	}
}
</script>