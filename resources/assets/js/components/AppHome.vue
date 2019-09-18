<template>
    <div class="container">
        <navbar></navbar>
        <router-view></router-view>
        <app-footer></app-footer>
    </div>
        
</template>

<script>
    import navbar from './NavBar'
    import AppFooter from './AppFooter'
    export default {
        components: {
            navbar, 
            AppFooter
        },
    }
</script>
