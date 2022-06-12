<template>
    <Head title="Tags" />

    <section>

        <div class="text-center mt-5 mb-5">
            <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">Posts related to Tag {{ tag.name }}</h2>
        </div>


        <RecentBlogs :posts="posts.data">

        </RecentBlogs>
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
        "tag": {
            type: Object
        },
       "posts": {
           type: Object
       }
    }
}
</script>
