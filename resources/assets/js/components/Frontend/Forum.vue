<template>
	<div class="row mt-5 mb-5">
		<div class="col-8">
			<question 
			v-for="question in questions"
			:key="question.path"
			:data=question
			></question>
		</div>
		<div class="col-4">
			<sidebar></sidebar>
		</div>
	</div>
</template>

<script>
import question from './Question'
import sidebar from './Sidebar'
export default {
	data() {
		return {
			questions: null
		}
	},
  components: {question, sidebar},
  created() {
  	axios.get('/api/question')
  	.then(res => {
  		this.questions = res.data.data
  		// console.log(err)
  	})
  	.catch(err => console.log(err))
  }
}
</script>