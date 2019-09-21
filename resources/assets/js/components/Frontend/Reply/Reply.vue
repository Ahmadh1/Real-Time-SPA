<template>
	<div class="card mt-2">
		<div class="card-header">
			<span>
				<b>{{ child.user }}</b>
				<p class="float-right text-muted"> replied {{ child.created_at }}</p>
			</span>
		</div>
		<div class="card-body">
			<edit-reply 
			v-if="editing"
			:reply = child
			></edit-reply>
			<p v-else v-html="reply"></p>
		</div>
		<div v-if="!editing">
			<div class="card-footer" v-if="own">
				<div class="">
					<button class="btn btn-sm btn-outline-dark" @click="edit">
						<i class="fas fa-pen"></i>
					</button>
					<button class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" @click="destroy"></i></button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import md from 'marked'
	import editReply from './EditReply'
	export default {
		data() {
			return {
				editing: false
			}
		},
		created() {
			this.listen();
		},
		components: {editReply},
		  props: ['child', 'index'],
		  computed: {
		  	own() {
		  		return User.own(this.child.user_id)
		  	},
		  	reply() {
		  		return md.parse(this.child.reply);
		  	}
		  },
		  methods: {
		  	destroy() {
		  		EventBus.$emit('deleteReply', this.index)
		  	},
		  	edit() {
		  		this.editing = true
		  	},
		  	listen() {
		  		EventBus.$on('cancelEdit', () => {
		  			this.editing = false
		  		})
		  	}
		  }
	}
</script>