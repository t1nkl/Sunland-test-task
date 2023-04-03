<template>
  <div>
    <form @submit.prevent="handleLogout">
      <button type="submit">Logout</button>
    </form>
  </div>
</template>

<script>
import { defineComponent, reactive } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default defineComponent({
  name: 'LogoutForm',
  setup() {
    const router = useRouter()


    const state = reactive({
      token: localStorage.getItem('token') || null,
      error: null,
    })

    async function handleLogout() {
      await requestApi('post', '/api/v1/logout', {});

      state.token = null
      localStorage.removeItem('token')
      router.push('/login')
    }

    async function requestApi(method, url, data = {}) {
      const token = localStorage.getItem('token');

      const headers = {
        'Content-Type': 'application/json',
      };

      if (token) {
        headers.Authorization = `Bearer ${token}`;
      }

      const config = {
        method,
        url,
        headers,
      };

      if (method === 'get') {
        config.params = data;
      } else {
        config.data = data;
      }

      try {
        const response = await axios(config);

        return response.data;
      } catch (error) {
        console.error(error);
      }
    }

    return {
      handleLogout
    }
  }
})
</script>
