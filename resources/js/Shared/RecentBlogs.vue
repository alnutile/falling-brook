<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="relative bg-gray-100 pt-4 pb-10 px-4 sm:px-6 lg:pt-4 lg:pb-14 lg:px-8">
    <div class="absolute inset-0">
      <div class="h-1/3 sm:h-2/3" />
    </div>
    <div class="relative max-w-7xl mx-auto">
        <div class="mt-6 max-w-lg mx-auto grid gap-5 lg:grid-cols-3 lg:max-w-none">
        <div v-for="post in posts" :key="post.id" class="flex flex-col rounded-lg shadow-lg overflow-hidden">
          <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" :src="post.hero" alt="" />
          </div>
          <div class="flex-1 bg-white p-6 flex flex-col justify-between">
            <div class="flex-1">
              <p class="text-sm font-medium text-indigo-600">
                <a :href="`/terms/${tag.id}`" class="hover:underline" v-for="tag in post.tags" :key="tag.id">
                  {{ tag.name }}&nbsp;
                </a>
              </p>
              <a :href="`/terms/${post.slug}`" class="block mt-2">
                <p class="text-xl font-semibold text-gray-900">
                  {{ post.title }}
                </p>
                <p class="mt-3 text-base text-gray-500" v-html="post.summary">
                </p>
              </a>
            </div>
            <div class="mt-6 flex items-center">
              <div class="flex-shrink-0">
                <a href="/about">
                  <span class="sr-only">Alfred Nutile</span>
                  <img class="h-10 w-10 rounded-full" src="/images/real_me_square.jpeg" alt="" />
                </a>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">
                  <a href="/about" class="hover:underline">
                    Alfred Nutile
                  </a>
                </p>
                <div class="flex space-x-1 text-sm text-gray-500">
                  <time :datetime="post.date">
                    {{ post.date }}
                  </time>
                  <span aria-hidden="true"> &middot; </span>
                  <span> {{ post.read_time }} min read </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['posts']
}
</script>
