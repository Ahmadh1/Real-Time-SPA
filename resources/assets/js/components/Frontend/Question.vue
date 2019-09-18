<template>
	<div class="card mb-2">
		<div class="card-header">
			<h4>
				<router-link class="text-dark" :to="data.path">{{ data.title }}</router-link>
			</h4>
			<span class="float-right text-muted">Asked by {{ data.user }} | {{ data.created_at }}</span>
		</div>
		<div class="card-body">
			<p v-html="data.body">
			</p>
		</div>
	</div>
</template>

<script>

export default {
	props: ['data']
}
</script>