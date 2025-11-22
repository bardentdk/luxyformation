<script setup>
defineProps({
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        default: ''
    }
});
</script>

<template>
    <div class="mb-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-dark">{{ title }}</h1>
                <p v-if="description" class="mt-2 text-sm text-gray-600">{{ description }}</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <slot name="actions" />
            </div>
        </div>
    </div>
</template>
