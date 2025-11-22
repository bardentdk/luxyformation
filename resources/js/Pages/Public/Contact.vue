<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { EnvelopeIcon, PhoneIcon, MapPinIcon } from '@heroicons/vue/24/outline';

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const submit = () => {
    form.post(route('contact.send'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <PublicLayout>
        <!-- Header -->
        <div class="bg-gradient-to-br from-primary-50 to-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl md:text-5xl font-bold text-dark mb-4">Contactez-nous</h1>
                <p class="text-xl text-gray-600">Une question ? N'hésitez pas à nous contacter</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Contact Info -->
                <div class="lg:col-span-1">
                    <h2 class="text-2xl font-bold text-dark mb-6">Nos coordonnées</h2>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-primary-100 rounded-lg">
                                <EnvelopeIcon class="h-6 w-6 text-primary" />
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark mb-1">Email</h3>
                                <p class="text-gray-600">contact@centreformation.fr</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-primary-100 rounded-lg">
                                <PhoneIcon class="h-6 w-6 text-primary" />
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark mb-1">Téléphone</h3>
                                <p class="text-gray-600">01 23 45 67 89</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="p-3 bg-primary-100 rounded-lg">
                                <MapPinIcon class="h-6 w-6 text-primary" />
                            </div>
                            <div>
                                <h3 class="font-semibold text-dark mb-1">Adresse</h3>
                                <p class="text-gray-600">123 Rue de la Formation<br>75001 Paris, France</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 p-6 bg-primary-50 rounded-lg">
                        <h3 class="font-semibold text-dark mb-2">Horaires d'ouverture</h3>
                        <p class="text-gray-700 text-sm">
                            Lundi - Vendredi: 9h00 - 18h00<br>
                            Samedi: 9h00 - 12h00<br>
                            Dimanche: Fermé
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="card">
                        <h2 class="text-2xl font-bold text-dark mb-6">Envoyez-nous un message</h2>

                        <form @submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="name" value="Nom complet *" />
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
                                    <InputLabel for="email" value="Email *" />
                                    <TextInput
                                        id="email"
                                        v-model="form.email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        required
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                            </div>

                            <div>
                                <InputLabel for="subject" value="Sujet *" />
                                <TextInput
                                    id="subject"
                                    v-model="form.subject"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.subject" />
                            </div>

                            <div>
                                <InputLabel for="message" value="Message *" />
                                <textarea
                                    id="message"
                                    v-model="form.message"
                                    rows="6"
                                    class="input mt-1 block w-full"
                                    required
                                    placeholder="Décrivez votre demande..."
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.message" />
                            </div>

                            <div class="flex justify-end">
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    :disabled="form.processing"
                                >
                                    <span v-if="form.processing">Envoi en cours...</span>
                                    <span v-else">Envoyer le message</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>
