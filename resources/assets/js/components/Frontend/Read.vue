<template>
	<div class="row mt-5 mb-5">
		<div class="col-10 offset-1">
			<div v-if="question">
				<edit 
				v-if="editing"
				:question = question
				></edit>	
				<show 
				:question = question
				v-else	
				></show>
				<replies :question=question></replies>
				<create-reply
				v-if="loggedIn"
				:questionSlug = question.slug>
				 </create-reply>
				 <div class="card mt-5" v-else>
				 	<div class="card-body">
				 		<router-link to="/login" class="text-danger text-uppercase">Click here to Login</router-link>
				 	</div>
				 </div>
			</div>
		</div>
	</div>
</template>

<script>
	import show from './ShowQuestion'
	import edit from './EditQuestion'
	import replies from './Reply/Replies'
	import CreateReply from './Reply/CreateReply'
	export default {
		components: {show, edit, replies, CreateReply},
		data() {
			return {
				question: null,
				editing: false
			}
		},
	  created() {
	    this.listen()
	    this.fetchQuestion()
	  },
	  computed: {
	  	loggedIn() {
	  		return User.loggedIn()
	  	}
	  },
	  methods: {
	  	listen() {
	  		
	  		EventBus.$on('startEditing', () => {
	  			this.editing = true
	  		})

	  		EventBus.$on('cancelEditing', () => {
	  			this.editing = false
	  		})
	  	},
	  	fetchQuestion() {
	  		axios.get(`/api/question/${this.$route.params.slug}`)
	    	.then((res) => {
	    		this.question = res.data.data
	    	}) 
	  	}
	  }
	}
	
</script>