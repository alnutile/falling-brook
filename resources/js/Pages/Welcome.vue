<template>
    <Head title="Welcome" />

    <Hero :github_results="github_results"></Hero>

    <RecentBlogs :posts="recents.data">

    </RecentBlogs>
</template>


<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import RecentBlogs from "@/Shared/RecentBlogs"
import Hero from "@/Shared/Hero"

export default {
    components: {
        Head,
        Link,
        Hero,
        RecentBlogs
    },
    props: {
        github_results: Array,
        recents: Array,
    }
}
</script>
