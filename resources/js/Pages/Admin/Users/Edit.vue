<script setup>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PageHeader from '@/Components/Admin/PageHeader.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.put(route('admin.users.update', props.user.id));
};
</script>

<template>
    <AdminLayout>
        <PageHeader
            title="Modifier l'utilisateur"
            :description="`Modifier les informations de ${user.name}`"
        />

        <div class="card max-w-2xl">
            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <InputLabel for="name" value="Nom" />
                    <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                        required
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="border-t pt-6">
                    <p class="text-sm text-gray-600 mb-4">
                        Laissez ces champs vides si vous ne souhaitez pas changer le mot de passe
                    </p>
                    <div class="space-y-4">
                        <div>
                            <InputLabel for="password" value="Nouveau mot de passe" />
                            <TextInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div>
                            <InputLabel for="password_confirmation" value="Confirmer le nouveau mot de passe" />
                            <TextInput
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                            />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <a :href="route('admin.users.index')" class="btn btn-outline">
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
