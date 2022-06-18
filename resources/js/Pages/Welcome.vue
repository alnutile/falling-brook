<template>
    <Head title="Alfred Nutile" />

    <Hero :github_results="github_results"></Hero>

    <Search v-if="searchFeatureOn" @search="searchMethod"></Search>

    <div class="text-center mt-3 mb-5">
        <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">
            <span v-if="search">
                Search Resource {{ recents.data.length }} found
            </span>
            <span v-else>Recent Posts</span>
        </h2>

        <p class="fmt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
            <TermLink v-for="tag in tags" :key="tag.id"
                      :term_label="tag.name"
                      :term_count="tag.posts_count"
                      :term_id="tag.id"></TermLink>
        </p>
    </div>

    <RecentBlogs :posts="recents.data"></RecentBlogs>
</template>


<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import RecentBlogs from "@/Shared/RecentBlogs"
import Hero from "@/Shared/Hero";
import Search from "@/Shared/Search";
import { featureFlag } from "@/Services/FeatureFlag"
import TermLink from "@/Pages/Terms/TermLink";

export default {
    components: {
        Head,
        Link,
        TermLink,
        Search,
        Hero,
        RecentBlogs
    },
    computed: {
        searchFeatureOn() {
            return featureFlag("search", this.$page)
        }
    },
    data() {
        return {
            search: null
        }
    },
    props: {
        github_results: Array,
        tags: Array,
        recents: Array,
        search: null
    },
    methods: {
        searchMethod(searchFor) {
            this.$inertia.reload({
                data: {
                "search": searchFor
                }
            })
        }
    },
}
</script>
