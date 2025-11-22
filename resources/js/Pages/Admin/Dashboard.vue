<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PageHeader from '@/Components/Admin/PageHeader.vue';
import { DocumentTextIcon, AcademicCapIcon, DocumentDuplicateIcon, UsersIcon } from '@heroicons/vue/24/outline';

defineProps({
    stats: {
        type: Object,
        default: () => ({
            users: 0,
            posts: 0,
            formations: 0,
            pages: 0
        })
    }
});

const cards = [
    { name: 'Utilisateurs', value: 'users', icon: UsersIcon, color: 'bg-blue-500' },
    { name: 'Articles de blog', value: 'posts', icon: DocumentTextIcon, color: 'bg-green-500' },
    { name: 'Formations', value: 'formations', icon: AcademicCapIcon, color: 'bg-purple-500' },
    { name: 'Pages', value: 'pages', icon: DocumentDuplicateIcon, color: 'bg-orange-500' },
];
</script>

<template>
    <AdminLayout>
        <PageHeader
            title="Dashboard"
            description="Bienvenue dans votre espace d'administration"
        />

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div
                v-for="card in cards"
                :key="card.name"
                class="card hover:shadow-md transition-shadow duration-200"
            >
                <div class="flex items-center">
                    <div :class="[card.color, 'rounded-lg p-3']">
                        <component :is="card.icon" class="h-6 w-6 text-white" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">{{ card.name }}</p>
                        <p class="text-2xl font-semibold text-dark">{{ stats[card.value] || 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="card">
                <h3 class="text-lg font-semibold text-dark mb-4">Activité récente</h3>
                <p class="text-sm text-gray-600">Les dernières activités apparaîtront ici.</p>
            </div>

            <div class="card">
                <h3 class="text-lg font-semibold text-dark mb-4">Actions rapides</h3>
                <div class="space-y-2">
                    <a href="/admin/posts/create" class="block text-sm text-primary hover:underline">
                        → Créer un nouvel article
                    </a>
                    <a href="/admin/formations/create" class="block text-sm text-primary hover:underline">
                        → Ajouter une formation
                    </a>
                    <a href="/admin/pages/create" class="block text-sm text-primary hover:underline">
                        → Créer une page
                    </a>
                    <a href="/admin/users/create" class="block text-sm text-primary hover:underline">
                        → Ajouter un utilisateur
                    </a>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
