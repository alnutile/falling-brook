<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="relative bg-gray-50 pt-4 pb-10 px-4 sm:px-6 lg:pt-4 lg:pb-14 lg:px-8 border-slate-300 border-b-2">
        <div class="flex-wrap gap-1 hidden sm:flex">
            <div
                :style="`background-color: ${day.color}`" class="w-20 h-20"
                v-for="day in github_results.days">
            </div>
        </div>
        <div class="sm:absolute inset-x-0 bottom-0 w-60 h-60 flex mx-auto min-w-max">
            <img alt="alfred" class="border border-4 border-white h-60 rounded rounded-full" src="/images/real_me_square.jpeg"/>
        </div>
    </div>
</template>

<script>
export default {
  props: ["github_results"]
}
</script>
