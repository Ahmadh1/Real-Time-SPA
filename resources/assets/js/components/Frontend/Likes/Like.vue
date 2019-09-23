<template>
	<span class="float-right">
		<button :class="classes" @click="like"><i class="far fa-heart"></i> {{ count }}</button>
	</span>
</template>

<script>
export default {
	props: ['content'],
	data() {
		return {
			liked: this.content.liked,
			count: this.content.like_count,
		}
	},
	computed: {
		classes() {
			return [
				'btn',
				this.liked ? 'btn-danger' : 'btn-outline-danger'
			];
		}
	},
	created() {
		Echo.channel('likeChannel')
		    .listen('LikeEvent', (e) => {
		        if (this.content.id == e.id) {
		        	e.type == 1 ? this.count++ : this.count--
		        }
		    });
	},
	methods: {
		like() {
			if (User.loggedIn()) {
				this.liked ? this.decr() : this.incr()
				this.liked = !this.liked
			}
		},
		incr() {
			axios.post(`/api/like/${this.content.id}`)
			.then((res) => {
				this.count ++
			})
		}, 
		decr() {
			axios.delete(`/api/like/${this.content.id}`)
			.then((res) => {
				this.count --
			})
		}
	}
}
</script>
