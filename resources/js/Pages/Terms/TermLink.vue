<template>
    <Link
        class="m-1 inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-300 text-gray-800"
        :href="route('terms.list', {'tag': term_id})">{{ term_label }}
            <span class="text-xs ml-1 text-gray-500">({{term_count}})</span></Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    name: "TermLink",
    components: {
        Link
    },
    props: ['term_id', "term_label", "term_count"]
}
</script>

<style scoped>

</style>
