<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import TaskItem from '@/Components/Tasks/TaskItem.vue'
import PrimaryLinkButton from '@/Components/PrimaryLinkButton.vue'

defineProps({
    tasks: Array
})
</script>

<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 space-y-6">
                        <div v-if="tasks.length">
                            <TaskItem v-for="task in tasks" :key="task.id" :task="task" />
                        </div>

                        <PrimaryLinkButton :href="route('tasks.create')" dusk="createTaskButton">
                            Create task
                        </PrimaryLinkButton>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
