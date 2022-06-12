<template>
    <Head title="Welcome" />

    <Hero :github_results="github_results"></Hero>

    <div class="text-center mt-5 mb-5">
        <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">Recent Posts</h2>
        <p class="fmt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
            <TermLink term_label="Laravel" term_id="5"></TermLink>
            <TermLink term_label="PHP" term_id="9"></TermLink>
            <TermLink term_label="Inertia" term_id="139"></TermLink>
            <TermLink term_label="Livewire" term_id="135"></TermLink>
            <TermLink term_label="Tailwind" term_id="140"></TermLink>
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
        recents: Array,
    }
}
</script>
