<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PageHeader from '@/Components/Admin/PageHeader.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    post: Object,
});

const form = useForm({
    title: props.post.title,
    slug: props.post.slug,
    excerpt: props.post.excerpt || '',
    content: props.post.content,
    featured_image: props.post.featured_image || '',
    status: props.post.status,
    published_at: props.post.published_at ? new Date(props.post.published_at).toISOString().slice(0, 16) : '',
});

const submit = () => {
    form.put(route('admin.posts.update', props.post.id));
};
</script>

<template>
    <AdminLayout>
        <PageHeader
            title="Modifier l'article"
            :description="`Modifier : ${post.title}`"
        />

        <div class="card max-w-4xl">
            <form @submit.prevent="submit" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <InputLabel for="title" value="Titre *" />
                        <TextInput
                            id="title"
                            v-model="form.title"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>

                    <div>
                        <InputLabel for="slug" value="Slug (URL)" />
                        <TextInput
                            id="slug"
                            v-model="form.slug"
                            type="text"
                            class="mt-1 block w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.slug" />
                    </div>
                </div>

                <div>
                    <InputLabel for="excerpt" value="Extrait" />
                    <textarea
                        id="excerpt"
                        v-model="form.excerpt"
                        rows="3"
                        class="input mt-1 block w-full"
                    ></textarea>
                    <InputError class="mt-2" :message="form.errors.excerpt" />
                </div>

                <div>
                    <InputLabel for="content" value="Contenu *" />
                    <textarea
                        id="content"
                        v-model="form.content"
                        rows="12"
                        class="input mt-1 block w-full"
                        required
                    ></textarea>
                    <InputError class="mt-2" :message="form.errors.content" />
                </div>

                <div>
                    <InputLabel for="featured_image" value="Image à la une (URL)" />
                    <TextInput
                        id="featured_image"
                        v-model="form.featured_image"
                        type="text"
                        class="mt-1 block w-full"
                    />
                    <InputError class="mt-2" :message="form.errors.featured_image" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <InputLabel for="status" value="Statut *" />
                        <select
                            id="status"
                            v-model="form.status"
                            class="input mt-1 block w-full"
                            required
                        >
                            <option value="draft">Brouillon</option>
                            <option value="published">Publié</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.status" />
                    </div>

                    <div>
                        <InputLabel for="published_at" value="Date de publication" />
                        <TextInput
                            id="published_at"
                            v-model="form.published_at"
                            type="datetime-local"
                            class="mt-1 block w-full"
                        />
                        <InputError class="mt-2" :message="form.errors.published_at" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <a :href="route('admin.posts.index')" class="btn btn-outline">
                        Annuler
                    </a>
                    <button type="submit" class="btn btn-primary" :disabled="form.processing">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
