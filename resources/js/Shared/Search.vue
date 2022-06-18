<template>
    <div class="flex justify-center mt-2 mx-auto">
        <input 
        class="border-1 border-gray-300 w-1/2"
        autofocus type="text" v-model="search" placeholder="Search posts.."/>
    </div>
</template>

<script>

export default {
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
