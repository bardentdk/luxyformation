<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Link } from '@inertiajs/vue3';
import { AcademicCapIcon, BookOpenIcon, UsersIcon, TrophyIcon } from '@heroicons/vue/24/outline';

defineProps({
    latestPosts: Array,
    upcomingFormations: Array,
});

const features = [
    {
        name: 'Formations certifiantes',
        description: 'Des formations reconnues et certifiées pour booster votre carrière',
        icon: AcademicCapIcon,
    },
    {
        name: 'Formateurs experts',
        description: 'Des professionnels expérimentés pour vous accompagner',
        icon: UsersIcon,
    },
    {
        name: 'Contenu riche',
        description: 'Des ressources pédagogiques de qualité et à jour',
        icon: BookOpenIcon,
    },
    {
        name: 'Réussite garantie',
        description: 'Un taux de réussite élevé grâce à notre méthode éprouvée',
        icon: TrophyIcon,
    },
];
</script>

<template>
    <PublicLayout>
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-primary-50 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold text-dark mb-6">
                        Développez vos <span class="text-primary">compétences</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto">
                        Découvrez nos formations professionnelles et donnez un nouvel élan à votre carrière
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link href="/formations" class="btn btn-primary text-lg px-8 py-3">
                            Voir les formations
                        </Link>
                        <Link href="/contact" class="btn btn-outline text-lg px-8 py-3">
                            Nous contacter
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Pourquoi nous choisir ?</h2>
                    <p class="text-lg text-gray-600">Les avantages de notre centre de formation</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div v-for="feature in features" :key="feature.name" class="text-center">
                        <div class="flex justify-center mb-4">
                            <div class="p-4 bg-primary-100 rounded-full">
                                <component :is="feature.icon" class="h-8 w-8 text-primary" />
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-dark mb-2">{{ feature.name }}</h3>
                        <p class="text-gray-600">{{ feature.description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Formations -->
        <div v-if="upcomingFormations && upcomingFormations.length > 0" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-12">
                    <h2 class="text-3xl font-bold text-dark">Formations à venir</h2>
                    <Link href="/formations" class="text-primary hover:text-primary-700 font-medium">
                        Voir toutes les formations →
                    </Link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div v-for="formation in upcomingFormations" :key="formation.id" class="card hover:shadow-lg transition-shadow">
                        <div v-if="formation.featured_image" class="mb-4">
                            <img :src="formation.featured_image" :alt="formation.title" class="w-full h-48 object-cover rounded-lg" />
                        </div>
                        <div class="flex items-center gap-2 mb-2">
                            <span v-if="formation.level" class="px-2 py-1 bg-primary-100 text-primary text-xs font-semibold rounded">
                                {{ formation.level }}
                            </span>
                            <span v-if="formation.duration" class="text-sm text-gray-500">
                                {{ formation.duration }}h
                            </span>
                        </div>
                        <h3 class="text-xl font-semibold text-dark mb-2">{{ formation.title }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ formation.description }}</p>
                        <div class="flex justify-between items-center">
                            <span v-if="formation.price" class="text-2xl font-bold text-primary">
                                {{ formation.price }}€
                            </span>
                            <Link :href="`/formations/${formation.slug}`" class="btn btn-primary">
                                En savoir plus
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Blog Posts -->
        <div v-if="latestPosts && latestPosts.length > 0" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-12">
                    <h2 class="text-3xl font-bold text-dark">Derniers articles</h2>
                    <Link href="/blog" class="text-primary hover:text-primary-700 font-medium">
                        Voir tous les articles →
                    </Link>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <article v-for="post in latestPosts" :key="post.id" class="card hover:shadow-lg transition-shadow">
                        <div v-if="post.featured_image" class="mb-4">
                            <img :src="post.featured_image" :alt="post.title" class="w-full h-48 object-cover rounded-lg" />
                        </div>
                        <div class="text-sm text-gray-500 mb-2">
                            {{ new Date(post.published_at).toLocaleDateString('fr-FR', { year: 'numeric', month: 'long', day: 'numeric' }) }}
                        </div>
                        <h3 class="text-xl font-semibold text-dark mb-2">{{ post.title }}</h3>
                        <p v-if="post.excerpt" class="text-gray-600 mb-4 line-clamp-3">{{ post.excerpt }}</p>
                        <Link :href="`/blog/${post.slug}`" class="text-primary hover:text-primary-700 font-medium">
                            Lire l'article →
                        </Link>
                    </article>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="py-20 bg-gradient-to-r from-primary to-primary-600">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Prêt à commencer votre formation ?
                </h2>
                <p class="text-xl text-white/90 mb-8">
                    Contactez-nous dès aujourd'hui pour discuter de vos besoins
                </p>
                <Link href="/contact" class="btn bg-white text-primary hover:bg-gray-100 text-lg px-8 py-3">
                    Contactez-nous
                </Link>
            </div>
        </div>
    </PublicLayout>
</template>
