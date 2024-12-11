<script setup>
import { router, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
    task: Object
})

const editing = ref(false)

const editForm = useForm({
    title: props.task.title
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
        <form v-if="editing" class="flex-grow">
            <TextInput dusk="taskEditInput" v-model="editForm.title" class="h-10 w-full" />
        </form>
        <div v-else>
            {{ task.title }}
        </div>
        <div class="space-x-6">
            <button dusk="taskEditButton" v-on:click="editing = !editing">Edit</button>
            <button dusk="taskDeleteButton" v-on:click="deleteTask" class="font-bold">Delete</button>
        </div>
    </div>
</template>

<style scoped>

</style>
