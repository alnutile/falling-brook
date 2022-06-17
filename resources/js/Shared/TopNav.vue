<template>
  <Disclosure as="nav" class="bg-white drop-shadow-sm" v-slot="{ open }">
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex items-center px-2 lg:px-0">
          <div class="flex-shrink-0">
              <Link :href="route('home')">Alfred Nutile</Link>
          </div>
        </div>

        <div class="flex-1 flex justify-center px-2 lg:ml-6 lg:justify-end" v-if="search">
          <div class="max-w-lg w-full lg:max-w-xs">
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
              </div>
              <input id="search" name="search" class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-gray-700 text-gray-300 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-white focus:ring-white focus:text-gray-900 sm:text-sm" placeholder="Search" type="search" />
            </div>
          </div>
        </div>


        <div class="flex lg:hidden">
          <!-- Mobile menu button -->
          <DisclosureButton class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
            <span class="sr-only">Open main menu</span>
            <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
        </div>
        <div class="hidden lg:block lg:ml-4">
          <div class="flex items-center">

          </div>
        </div>

          <div class="hidden lg:block lg:ml-6">
              <div class="flex space-x-4">
                  <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                  <Link :href="route('home')"
                        :class="{ 'underline text-gray-800': $page.component === 'Welcome' }"
                        class="text-gray-700 hover:underline px-3 py-2 rounded-md text-sm font-medium">Home</Link>

                  <Link :href="route('posts.index')"
                        :class="{ 'underline text-gray-800': $page.component === 'Posts/Index' }"
                        class="text-gray-700 hover:underline px-3 py-2 rounded-md text-sm font-medium">Posts</Link>

                  <Link :href="route('about')"
                        :class="{ 'underline text-gray-800': $page.component === 'Posts/About' }"
                        class="text-gray-700 hover:underline px-3 py-2 rounded-md text-sm font-medium">About</Link>

              </div>
          </div>


      </div>
    </div>

    <DisclosurePanel class="lg:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <DisclosureButton as="a" :href="route('home')"
        :class="{ 'bg-gray-900 text-white block ': $page.component === 'Welcome' }"
        class="text-gray-300 hover:bg-gray-700 block px-3 py-2 rounded-md text-base font-medium">Home</DisclosureButton>
        <DisclosureButton as="a" :href="route('posts.index')" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
            Post
        </DisclosureButton>
        <DisclosureButton as="a" :href="route('about')" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About</DisclosureButton>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { SearchIcon } from '@heroicons/vue/solid'
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'
import { featureFlag } from "@/Services/FeatureFlag"
import { Link } from "@inertiajs/inertia-vue3"

export default {
  components: {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Link,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    BellIcon,
    MenuIcon,
    SearchIcon,
    XIcon,
  },
  data() {
      return {
          open: false,
      }
  },
  computed: {
    search() {
      return featureFlag("search", this.$page);
    }
  }
}
</script>
