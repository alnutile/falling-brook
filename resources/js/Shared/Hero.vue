<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div>
        <div
            class="grid grid-cols-10 gap-4"
            v-for="week in github_results.data.user.contributionsCollection.contributionCalendar.weeks">
            <div
                v-for="day in week.contributionDays" :key="day.weekday">
                {{day.date}}
                <div :style="`background-color: ${day.color}`">{{ day.contributionCount }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  props: ["github_results"]
}
</script>
