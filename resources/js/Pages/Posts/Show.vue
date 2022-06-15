<template>

    <div class="flex mx-auto sm:items-center flex-col mt-10 mb-10">
        <div class="relative py-16 bg-white overflow-hidden">
            <div class="relative px-4 sm:px-6 lg:px-8">
                <div class="text-lg max-w-prose mx-auto">
                    <h1>
                        <span class="block text-base text-center text-indigo-600 font-semibold tracking-wide uppercase items-center">
                            <span v-for="(tag, index) in post.data.tags" :key="tag.id">{{ tag.name }}
                                <span v-if="index < (post.data.tags.length - 1)" class="items-center mr-1">🚀</span>
                            </span>
                        </span>
                        <span class="mt-2 block text-3xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ post.data.title }}</span>
                    </h1>
                </div>
                <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto" v-html="post.data.html">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Show",
    props: ["post"]
}
</script>

<style scoped>

</style>
