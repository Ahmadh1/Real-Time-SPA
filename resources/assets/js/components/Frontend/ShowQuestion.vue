<template>
	<div class="card">
		<div class="card-header"><h4>{{ question.title }}</h4>
			<span class="float-right text-muted">Asked by: {{ question.user }} | {{ question.created_at }}</span>
		</div>
		<div class="card-body">
			<p v-html="body"></p>
		</div>
		<div>
			<div class="card-footer">
				<span class="badge badge-pill badge-dark">{{ question.replies_count }} <i class="fa fa-reply"></i></span>
				<span class="float-right" v-if="own">
					<button class="btn btn-sm btn-outline-primary"><i class="fas fa-pen" @click="edit"></i></button>
					<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash" @click="destroy"></i></button>
				</span>
			</div>
		</div>
	</div>
</template>

<script>
import md from 'marked'
export default {
	data() {
		return {
			own: User.own(this.question.user_id)
		}
	},
	props: ['question'],
	computed: {
		body() {
			return md.parse(this.question.body);
		}
	},
	methods: {
		destroy() {
			axios.delete(`/api/question/${this.question.slug}`)
				.then((res) => {
					this.$router.push('/home')
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