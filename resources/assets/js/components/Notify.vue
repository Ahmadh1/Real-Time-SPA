<template>
	<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i :class="classes"></i> <sup :class="count">{{ unreadCount }}</sup>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        	<!-- unread -->
        	<li v-for="item in unread" :key="item.id">
        		<router-link class="dropdown-item" :to="item.path">
		           <span @click="readIt(item)" class="text-danger">{{ item.replyBy }} <small> replied on</small> {{ item.question }}</span>
		      	</router-link>		
        	</li>
          
          <!-- <div class="dropdown-divider"></div> -->
          
          <li v-for="item in read" :key="item.id">
          	<a class="dropdown-item disabled">
	          	{{ item.question }}
	        </a>
          </li>
        	
        </div>
    </li>
</template>

<script>
export default {
	data() {
		return {
			read: {},
			unread: {},
			unreadCount: 0,
			sound: "http://soundbible.com/mp3/glass_ping-Go445-1207030150.mp3"
		}
	},
	created() {
		if (User.loggedIn()) {
			this.getNotification();
		}
		Echo.private('App.User.' + User.id())
			    .notification((notification) => {
			    	this.playSound();
			        this.unread.unshift(notification);
			        this.unreadCount++;
			    });
	},
	methods: {
		playSound() {
			let alert = new Audio(this.sound);
      		alert.play();
		},
		getNotification() {
			axios.post('/api/notifications')
				.then((res) => {
					this.read = res.data.read;
          			this.unread = res.data.unread;
          			this.unreadCount = res.data.unread.length;
				})
				.catch((err) => {
					Exception.handle(err);
				})
		},
		readIt(notification) {
     	 axios.post("/api/markAsRead", { id: notification.id }).then(res => {
	        this.unread.splice(notification, 1);
	        this.read.push(notification);
	        this.unreadCount--;
      });
    }
	},
	computed: {
    classes() {
      return [
	      'fa fa-bell',
	      this.unreadCount > 0 ? 'text-danger' : 'text-muted'
      ];
    },
    count() {
    	return this.unreadCount > 0 ? 'text-danger' : 'text-muted';
    }
  }
}
</script>
<style>
	.dropdown-toggle::after {
		border: 0;
	}
</style>