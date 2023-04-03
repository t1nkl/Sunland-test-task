<template>
  <div>
    <h1>DashboardView</h1>
    <LogoutForm />
  </div>
</template>

<script>
import LogoutForm from '../components/LogoutForm.vue'

export default {
  name: 'DashboardView',
  components: { LogoutForm },
  computed: {
    token() {
      return localStorage.getItem('token');
    }
  },
  mounted() {
    if (!this.token) {
      this.$router.push('/login');
    }
  }
};

</script>
