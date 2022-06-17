<template>
    <Head title="Alfred Nutile" />

    <Hero :github_results="github_results"></Hero>

    <div class="text-center mt-5 mb-5">
        <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">Recent Posts</h2>
        <p class="fmt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
            <TermLink v-for="tag in tags" :key="tag.id"
                      :term_label="tag.name"
                      :term_count="tag.posts_count"
                      :term_id="tag.id"></TermLink>
        </p>
    </div>

    <RecentBlogs :posts="recents.data">

    </RecentBlogs>
</template>


<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import RecentBlogs from "@/Shared/RecentBlogs"
import Hero from "@/Shared/Hero";
import TermLink from "@/Pages/Terms/TermLink";


export default {
    components: {
        Head,
        Link,
        TermLink,
        Hero,
        RecentBlogs
    },
    props: {
        github_results: Array,
        tags: Array,
        recents: Array,
    }
}
</script>
