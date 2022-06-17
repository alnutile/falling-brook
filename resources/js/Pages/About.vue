<template>
    <Head title="About" />

    <div class="flex mx-auto sm:items-center flex-col mt-10 mb-10">
        <div class="relative py-16 bg-white overflow-hidden">
            <div class="relative px-4 sm:px-6 lg:px-8">
                <div class="text-lg max-w-prose mx-auto">
                    <span class="block text-base text-center text-indigo-600 font-semibold tracking-wide uppercase items-center">
                        <span>Alfred <span class="items-center mr-1">🚀</span>  Nutile
                        </span>
                    </span>
                    <h1>
                        <span class="mt-2 block text-3xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">About</span>
                    </h1>
                </div>
                <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto">
                    <p>
                        I have been in the industry for 20+ years. My roots are in coding and a passion for technology. 
                        For the past several years, I have been building and leading a team to create technologies to assist in the digital transformation in my current role.
                    </p>
                    <p>
                        Worked at <b>Pfizer</b> for 10 years building amazing products and working with an amazing team.
                    </p>

                    <p>
                        Now I am building great products for companies like <a href="https://resurva.com/" target="_blank">Resurva</a>
                        and <a href="https://www.unearthcampaigns.com/" target="_blank">Unearth</a> and more products including 
                        <a href="https://galleryanywhere.com/" target="_blank">Gallery Anywhere</a> and 
                        <a href="https://totalrecalls.io/" target="_blank">TotalRecalls.io</a>
                    </p>

                        <div>
                            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-md font-medium text-gray-500 truncate">GitHub</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">
                                The place that matters for developers 🙂
                                <a href="https://github.com/alnutile" target="_blank">here</a>
                            </dd>
                            </div>

                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-md font-medium text-gray-500 truncate">YouTube</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">
                                More content coming soon! 📺
                                <a href="https://www.youtube.com/c/AlfredNutile" target="_blank">here</a>
                            </dd>
                            </div>

                            <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                            <dt class="text-md font-medium text-gray-500 truncate">LinkedIn</dt>
                            <dd class="mt-1 text-sm font-semibold text-gray-900">
                                Some posts, connections and recommendations. 👉
                                <a href="https://www.linkedin.com/in/alfrednutile/" target="_blank">here</a>
                            </dd>
                            </div>
                        </dl>
                        </div>

                </div>
            </div>
        </div>
    </div>
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
