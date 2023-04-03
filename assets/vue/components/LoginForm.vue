<template>
  <div>
    <form @submit.prevent="handleLogin">
      <label for="email">Email:</label>
      <input type="text" id="inputEmail" v-model="form.email" name="email" autocomplete="email" required autofocus />
      <br />

      <label for="password">Password:</label>
      <input type="password" id="inputPassword" v-model="form.password" name="password" autocomplete="current-password" required>

      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import { reactive } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default {
  name: 'LoginForm',
  setup() {
    const router = useRouter()

    const state = reactive({
      token: localStorage.getItem('token') || null,
      error: null,
    })

    const form = reactive({
      email: '',
      password: '',
    })

    async function handleLogin() {
      const csrfToken = document.querySelector('input[name="_csrf_token"]').value;

      try {
        const response = await axios.post(
            '/api/v1/login',
            {
              email: form.email,
              password: form.password,
              _csrf_token: csrfToken,
            },
            {
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              }
            }
        )

        if (response.status === 200) {
          state.token = response.data.token
          localStorage.setItem('token', state.token)
          router.push('/dashboard')
        }
      } catch (error) {
        state.error = error.response.data.message
      }
    }

    return {
      form,
      state,
      handleLogin
    }
  }
}
</script>
