<script setup>
defineProps({
    task: Object
})
</script>

<template>
    <div dusk="taskItem">
        {{ task.title }}
    </div>
</template>

<style scoped>

</style>
