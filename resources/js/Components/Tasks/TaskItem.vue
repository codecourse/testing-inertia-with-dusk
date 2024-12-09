<script setup>
defineProps({
    task: Object
})
</script>

<template>
    <div dusk="taskItem" class="flex items-center justify-between h-10 space-x-6">
        {{ task.title }}
    </div>
</template>

<style scoped>

</style>
