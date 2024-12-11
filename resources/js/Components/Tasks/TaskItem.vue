<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
    task: Object
})

const deleteTask = () => {
    if (!window.confirm('Are you sure?')) {
        return
    }

    router.delete(route('tasks.destroy', props.task))
}
</script>

<template>
    <div dusk="taskItem" class="flex items-center justify-between h-10 space-x-6">
        <div>
            {{ task.title }}
        </div>
        <div class="space-x-6">
            <button dusk="taskDeleteButton" v-on:click="deleteTask" class="font-bold">Delete</button>
        </div>
    </div>
</template>

<style scoped>

</style>
