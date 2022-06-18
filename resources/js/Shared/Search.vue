<template>
    <div class="flex justify-center mt-2 mx-auto p-2">
        <input 
        class="border-1 border-gray-300 sm:w-1/2 w-full"
        autofocus type="text" v-model="search" placeholder="Search posts.."/>
    </div>
</template>

<script>

export default {
    props: ['searchFilter'],
    mounted() {
        this.search = this.searchFilter;
    },
    data() {
        return {
            search: null
        }
    },
    watch: {
        search: _.debounce(function(newValue) {
            this.searchEvent(newValue);
        }, 500)
    },
    methods: {
        searchEvent(search) {
            console.log("event", search)
            this.$emit('search', search);
        }
    }
}
</script>
