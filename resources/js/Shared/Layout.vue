<template>
  <div class="flex flex-col justify-between min-h-screen">
      <header>
        <TopNav></TopNav>
      </header>
      <main class="flex-grow mb-auto mt-1">
          <slot />
      </main>
      <!-- footer coming soon -->
      <footer>
        <Footer></Footer>
      </footer>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Footer from "@/Shared/Footer"
import TopNav from "@/Shared/TopNav"

export default {
  components: {
    Link,
    TopNav,
    Footer
  },
}
</script>
