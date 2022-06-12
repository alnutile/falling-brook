<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="relative bg-gray-50 pt-4 pb-10 px-4 sm:px-6 lg:pt-4 lg:pb-14 lg:px-8 border-slate-300 border-b-2">
        <div class="flex-wrap gap-1 flex">
            <div
                :style="`background-color: ${day.color}`" class="sm:w-20 sm:h-20 w-5 h-5"
                v-for="day in github_results.days">
            </div>
        </div>
        <div class="absolute inset-x-0 bottom-5 h-24 w-24 sm:w-60 sm:h-60 flex mx-auto min-w-max">
            <img alt="alfred" class="border border-4 border-white sm:h-60 h-24 rounded rounded-full" src="/images/real_me_square.jpeg"/>
        </div>
    </div>
</template>

<script>
export default {
  props: ["github_results"]
}
</script>
