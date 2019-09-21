<template>
	<div class="card">
		<ul class="list-group list-group-flush">
			<li class="list-group-item active">All Categories</li>
			<div v-for="cat in categories">
		  		<li class="list-group-item">{{ cat.title }}</li>
		  	</div>
		</ul>
	</div>
</template>

<script>
export default {
	data() {
		return {
			categories: {}
		}
	},
	created() {
		axios.get('/api/category')
			.then((res) => {
				this.categories = res.data.data
			})
	}
}
</script>
<style scoped>
	.list-group-item.active{
		background: #38C172;
		border: none;
	}
</style>