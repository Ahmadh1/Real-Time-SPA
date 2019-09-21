<template>
	<div>
		<div class="form-group">
			<vue-simplemde v-model="reply.reply" />
		</div>
		<div class="btn-group">
			<button class="btn btn-outline-danger" @click="update">Save</button>
			<button class="btn btn-outline-dark" @click="cancel">Cancel</button>
		</div>
	</div>
</template>

<script>
export default {
	props: ['reply'],
	methods: {
		cancel() {
			EventBus.$emit('cancelEdit');
		}, 
		update() {
			axios.patch(`/api/question/${this.reply.question_slug}/reply/${this.reply.id}`, {body: this.reply.reply})
				.then((res) => {
					this.cancel()
				})
		}
	}
}
</script>