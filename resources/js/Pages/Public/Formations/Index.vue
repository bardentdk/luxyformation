<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ClockIcon, UserGroupIcon, AcademicCapIcon } from '@heroicons/vue/24/outline';

defineProps({
    formations: Object,
});
</script>

<template>
    <PublicLayout>
        <!-- Header -->
        <div class="bg-gradient-to-br from-primary-50 to-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl md:text-5xl font-bold text-dark mb-4">Nos Formations</h1>
                <p class="text-xl text-gray-600">Trouvez la formation qui correspond à vos objectifs professionnels</p>
            </div>
        </div>

        <!-- Formations Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div v-if="formations.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="formation in formations.data" :key="formation.id" class="card hover:shadow-xl transition-all">
                    <div v-if="formation.featured_image" class="mb-4 -mx-6 -mt-6">
                        <img :src="formation.featured_image" :alt="formation.title" class="w-full h-48 object-cover rounded-t-xl" />
                    </div>

                    <div class="flex items-center gap-2 mb-3">
                        <span v-if="formation.level" class="px-3 py-1 bg-primary-100 text-primary text-xs font-semibold rounded-full">
                            {{ formation.level }}
                        </span>
                    </div>

                    <h2 class="text-xl font-bold text-dark mb-3">{{ formation.title }}</h2>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ formation.description || formation.content.substring(0, 150) + '...' }}</p>

                    <div class="space-y-2 mb-4 text-sm text-gray-600">
                        <div v-if="formation.duration" class="flex items-center gap-2">
                            <ClockIcon class="h-5 w-5 text-primary" />
                            <span>{{ formation.duration }} heures</span>
                        </div>
                        <div v-if="formation.max_participants" class="flex items-center gap-2">
                            <UserGroupIcon class="h-5 w-5 text-primary" />
                            <span>Max {{ formation.max_participants }} participants</span>
                        </div>
                        <div v-if="formation.start_date" class="flex items-center gap-2">
                            <AcademicCapIcon class="h-5 w-5 text-primary" />
                            <span>Début : {{ new Date(formation.start_date).toLocaleDateString('fr-FR') }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t">
                        <span v-if="formation.price" class="text-2xl font-bold text-primary">
                            {{ formation.price }}€
                        </span>
                        <span v-else class="text-gray-500">Prix sur demande</span>
                        <Link :href="`/formations/${formation.slug}`" class="btn btn-primary">
                            Détails
                        </Link>
                    </div>
                </div>
            </div>

            <div v-else class="text-center py-12">
                <p class="text-gray-500 text-lg">Aucune formation disponible pour le moment.</p>
            </div>

            <!-- Pagination -->
            <div v-if="formations.links.length > 3" class="mt-12 flex justify-center">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                    <Link
                        v-for="(link, index) in formations.links"
                        :key="index"
                        :href="link.url"
                        :class="[
                            link.active
                                ? 'z-10 bg-primary border-primary text-white'
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                            'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                            index === 0 ? 'rounded-l-md' : '',
                            index === formations.links.length - 1 ? 'rounded-r-md' : ''
                        ]"
                        v-html="link.label"
                    />
                </nav>
            </div>
        </div>
    </PublicLayout>
</template>
