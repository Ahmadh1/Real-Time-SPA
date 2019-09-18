<template>
	<div class="card">
		<div class="card-header"><h4>{{ question.title }}</h4>
			<span class="float-right text-muted">Asked by: {{ question.user }} | {{ question.created_at }}</span>
		</div>
		<div class="card-body">
			<p v-html="question.body"></p>
		</div>
		<div>
			<div class="card-footer">
				<span>5 <i class="fas fa-comment-dots"></i></span>
				<span class="float-right" v-if="own">
					<button class="btn btn-sm btn-outline-primary"><i class="fas fa-pen" @click="edit"></i></button>
					<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash" @click="destroy"></i></button>
				</span>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			own: User.own(this.question.user_id)
		}
	},
	props: ['question'],
	methods: {
		destroy() {
			axios.delete(`/api/question/${this.question.slug}`)
				.then((res) => {
					this.$router.push('/index')
				})
				.catch((err) => {
					console.log(err.response.errors)
				})
		},
		edit() {
			EventBus.$emit('startEditing');
		}
	}
}
</script>