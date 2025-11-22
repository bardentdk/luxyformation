<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PageHeader from '@/Components/Admin/PageHeader.vue';
import Table from '@/Components/Admin/Table.vue';
import Modal from '@/Components/Admin/Modal.vue';
import { PencilIcon, TrashIcon, PlusIcon, EyeIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    posts: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const status = ref(props.filters?.status || '');
const showDeleteModal = ref(false);
const postToDelete = ref(null);

const searchPosts = () => {
    router.get(route('admin.posts.index'), {
        search: search.value,
        status: status.value
    }, {
        preserveState: true,
        replace: true,
    });
};

const confirmDelete = (post) => {
    postToDelete.value = post;
    showDeleteModal.value = true;
};

const deletePost = () => {
    router.delete(route('admin.posts.destroy', postToDelete.value.id), {
        onSuccess: () => {
            showDeleteModal.value = false;
            postToDelete.value = null;
        }
    });
};

const getStatusBadge = (status) => {
    return status === 'published'
        ? 'bg-green-100 text-green-800'
        : 'bg-yellow-100 text-yellow-800';
};

const headers = [
    { label: 'Titre', key: 'title' },
    { label: 'Auteur', key: 'author' },
    { label: 'Statut', key: 'status' },
    { label: 'Date', key: 'created_at' },
    { label: 'Actions', key: 'actions' },
];
</script>

<template>
    <AdminLayout>
        <PageHeader
            title="Articles de blog"
            description="Gérer les articles de votre blog"
        >
            <template #actions>
                <Link
                    :href="route('admin.posts.create')"
                    class="btn btn-primary"
                >
                    <PlusIcon class="h-5 w-5 mr-2" />
                    Nouvel article
                </Link>
            </template>
        </PageHeader>

        <!-- Filters -->
        <div class="mb-6 flex gap-4">
            <input
                v-model="search"
                type="text"
                placeholder="Rechercher un article..."
                class="input w-full max-w-md"
                @input="searchPosts"
            />
            <select
                v-model="status"
                class="input max-w-xs"
                @change="searchPosts"
            >
                <option value="">Tous les statuts</option>
                <option value="draft">Brouillons</option>
                <option value="published">Publiés</option>
            </select>
        </div>

        <!-- Table -->
        <Table :headers="headers">
            <tr v-for="post in posts.data" :key="post.id" class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">{{ post.title }}</div>
                    <div v-if="post.excerpt" class="text-sm text-gray-500 truncate max-w-md">
                        {{ post.excerpt }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ post.user?.name || 'N/A' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span :class="[getStatusBadge(post.status), 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full']">
                        {{ post.status === 'published' ? 'Publié' : 'Brouillon' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">
                        {{ new Date(post.created_at).toLocaleDateString('fr-FR') }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                    <Link
                        :href="route('admin.posts.edit', post.id)"
                        class="text-primary hover:text-primary-700 inline-flex items-center"
                    >
                        <PencilIcon class="h-4 w-4 mr-1" />
                        Modifier
                    </Link>
                    <button
                        @click="confirmDelete(post)"
                        class="text-red-600 hover:text-red-900 inline-flex items-center"
                    >
                        <TrashIcon class="h-4 w-4 mr-1" />
                        Supprimer
                    </button>
                </td>
            </tr>
            <tr v-if="posts.data.length === 0">
                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                    Aucun article trouvé
                </td>
            </tr>
        </Table>

        <!-- Pagination -->
        <div v-if="posts.links.length > 3" class="mt-6 flex justify-center">
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

        <!-- Delete Modal -->
        <Modal :show="showDeleteModal" @close="showDeleteModal = false" title="Supprimer l'article">
            <p class="text-sm text-gray-500">
                Êtes-vous sûr de vouloir supprimer l'article <strong>{{ postToDelete?.title }}</strong> ?
                Cette action est irréversible.
            </p>
            <template #footer>
                <button
                    @click="showDeleteModal = false"
                    class="btn btn-outline mr-2"
                >
                    Annuler
                </button>
                <button
                    @click="deletePost"
                    class="btn bg-red-600 text-white hover:bg-red-700"
                >
                    Supprimer
                </button>
            </template>
        </Modal>
    </AdminLayout>
</template>
