<template>
    <Head title="Posts" />

    <section>

        <div class="text-center mt-5 mb-5">
            <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">Posts</h2>
        </div>

        <RecentBlogs :posts="posts.data">

        </RecentBlogs>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 drop-shadow-md" aria-label="Pagination">
            <div class="hidden sm:block">
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{posts.meta.from}}</span>
                    to
                    <span class="font-medium">{{posts.meta.to}}</span>
                    of
                    <span class="font-medium">{{posts.meta.total}}</span>
                    results
                </p>
            </div>
            <div class="flex-1 flex justify-between sm:justify-end">
                <Link :href="posts.links.last" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </Link>
                <Link :href="posts.links.next" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </Link>
            </div>
        </nav>
    </section>

</template>


<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import RecentBlogs from "../../Shared/RecentBlogs";

export default {
    components: {
        Head,
        Link,
        RecentBlogs
    },
    props: {
        "posts": {
            type: Object
        }
    }
}
</script>
