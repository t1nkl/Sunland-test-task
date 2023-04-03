<template>
  <div>
    <form @submit.prevent="handleLogout">
      <button type="submit">Logout</button>
    </form>
  </div>
</template>

<script>
import { reactive } from 'vue'
import { useRouter } from 'vue-router'

export default {
  name: 'LogoutForm',
  setup() {
    const router = useRouter()

    const state = reactive({
      token: localStorage.getItem('token') || null,
      error: null,
    })

    async function handleLogout() {
      await request('post', '/api/v1/logout');

      state.token = null
      localStorage.removeItem('token')
      await router.push('/login')
    }

    const request = async (method, url) => {
      try {
        const response = await fetch(url, {
          method: method,
          headers: {
            'Authorization': `Bearer ${state.token}`
          }
        })
        if (response.status === 401) {
          // handle unauthorized request
          throw new Error('Unauthorized')
        }
        return await response.json()
      } catch (error) {
        console.error(error)
        state.error = error
      }
    }

    return {
      handleLogout,
    }
  }
}
</script>
