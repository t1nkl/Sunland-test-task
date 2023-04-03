<template>
  <main id="elementor" class="elementor">
    <RouterView v-slot="{ Component }">
      <transition mode="out-in" name="page">
        <component :is="Component" />
      </transition>
    </RouterView>
  </main>
</template>

<script>

export default {
  name: "Elementor"
};
</script>
