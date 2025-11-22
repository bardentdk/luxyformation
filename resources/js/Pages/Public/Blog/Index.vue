<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    posts: Object,
});
</script>

<template>
    <PublicLayout>
        <!-- Header -->
        <div class="bg-gradient-to-br from-primary-50 to-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl md:text-5xl font-bold text-dark mb-4">Notre Blog</h1>
                <p class="text-xl text-gray-600">Actualités, conseils et ressources pour votre formation</p>
            </div>
        </div>

        <!-- Posts Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div v-if="posts.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <article v-for="post in posts.data" :key="post.id" class="card hover:shadow-lg transition-shadow">
                    <div v-if="post.featured_image" class="mb-4">
                        <img :src="post.featured_image" :alt="post.title" class="w-full h-48 object-cover rounded-lg" />
                    </div>
                    <div class="text-sm text-gray-500 mb-2">
                        <span>Par {{ post.user?.name || 'Admin' }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ new Date(post.published_at).toLocaleDateString('fr-FR') }}</span>
                    </div>
                    <h2 class="text-xl font-semibold text-dark mb-2 hover:text-primary transition-colors">
                        <Link :href="`/blog/${post.slug}`">
                            {{ post.title }}
                        </Link>
                    </h2>
                    <p v-if="post.excerpt" class="text-gray-600 mb-4 line-clamp-3">{{ post.excerpt }}</p>
                    <Link :href="`/blog/${post.slug}`" class="text-primary hover:text-primary-700 font-medium">
                        Lire la suite →
                    </Link>
                </article>
            </div>

            <div v-else class="text-center py-12">
                <p class="text-gray-500 text-lg">Aucun article publié pour le moment.</p>
            </div>

            <!-- Pagination -->
            <div v-if="posts.links.length > 3" class="mt-12 flex justify-center">
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                    <Link
                        v-for="(link, index) in posts.links"
                        :key="index"
                        :href="link.url"
                        :class="[
                            link.active
                                ? 'z-10 bg-primary border-primary text-white'
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                            'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                            index === 0 ? 'rounded-l-md' : '',
                            index === posts.links.length - 1 ? 'rounded-r-md' : ''
                        ]"
                        v-html="link.label"
                    />
                </nav>
            </div>
        </div>
    </PublicLayout>
</template>
