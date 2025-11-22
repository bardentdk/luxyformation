<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PageHeader from '@/Components/Admin/PageHeader.vue';
import Table from '@/Components/Admin/Table.vue';
import Modal from '@/Components/Admin/Modal.vue';
import { PencilIcon, TrashIcon, PlusIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    users: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const showDeleteModal = ref(false);
const userToDelete = ref(null);

const searchUsers = () => {
    router.get(route('admin.users.index'), { search: search.value }, {
        preserveState: true,
        replace: true,
    });
};

const confirmDelete = (user) => {
    userToDelete.value = user;
    showDeleteModal.value = true;
};

const deleteUser = () => {
    router.delete(route('admin.users.destroy', userToDelete.value.id), {
        onSuccess: () => {
            showDeleteModal.value = false;
            userToDelete.value = null;
        }
    });
};

const headers = [
    { label: 'Nom', key: 'name' },
    { label: 'Email', key: 'email' },
    { label: 'Créé le', key: 'created_at' },
    { label: 'Actions', key: 'actions' },
];
</script>

<template>
    <AdminLayout>
        <PageHeader
            title="Utilisateurs"
            description="Gérer les utilisateurs de votre centre de formation"
        >
            <template #actions>
                <Link
                    :href="route('admin.users.create')"
                    class="btn btn-primary"
                >
                    <PlusIcon class="h-5 w-5 mr-2" />
                    Nouvel utilisateur
                </Link>
            </template>
        </PageHeader>

        <!-- Search -->
        <div class="mb-6">
            <input
                v-model="search"
                type="text"
                placeholder="Rechercher un utilisateur..."
                class="input w-full max-w-md"
                @input="searchUsers"
            />
        </div>

        <!-- Table -->
        <Table :headers="headers">
            <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">{{ user.email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-500">
                        {{ new Date(user.created_at).toLocaleDateString('fr-FR') }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                    <Link
                        :href="route('admin.users.edit', user.id)"
                        class="text-primary hover:text-primary-700 inline-flex items-center"
                    >
                        <PencilIcon class="h-4 w-4 mr-1" />
                        Modifier
                    </Link>
                    <button
                        @click="confirmDelete(user)"
                        class="text-red-600 hover:text-red-900 inline-flex items-center"
                    >
                        <TrashIcon class="h-4 w-4 mr-1" />
                        Supprimer
                    </button>
                </td>
            </tr>
            <tr v-if="users.data.length === 0">
                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                    Aucun utilisateur trouvé
                </td>
            </tr>
        </Table>

        <!-- Pagination -->
        <div v-if="users.links.length > 3" class="mt-6 flex justify-center">
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                <Link
                    v-for="(link, index) in users.links"
                    :key="index"
                    :href="link.url"
                    :class="[
                        link.active
                            ? 'z-10 bg-primary border-primary text-white'
                            : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                        'relative inline-flex items-center px-4 py-2 border text-sm font-medium',
                        index === 0 ? 'rounded-l-md' : '',
                        index === users.links.length - 1 ? 'rounded-r-md' : ''
                    ]"
                    v-html="link.label"
                />
            </nav>
        </div>

        <!-- Delete Modal -->
        <Modal :show="showDeleteModal" @close="showDeleteModal = false" title="Supprimer l'utilisateur">
            <p class="text-sm text-gray-500">
                Êtes-vous sûr de vouloir supprimer l'utilisateur <strong>{{ userToDelete?.name }}</strong> ?
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
                    @click="deleteUser"
                    class="btn bg-red-600 text-white hover:bg-red-700"
                >
                    Supprimer
                </button>
            </template>
        </Modal>
    </AdminLayout>
</template>
