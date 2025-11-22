<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline';

const page = usePage();
const mobileMenuOpen = ref(false);

const navigation = [
    { name: 'Accueil', href: '/' },
    { name: 'Blog', href: '/blog' },
    { name: 'Formations', href: '/formations' },
    { name: 'Contact', href: '/contact' },
];
</script>

<template>
    <div class="min-h-screen bg-white">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <Link href="/" class="flex items-center">
                            <h1 class="text-2xl font-bold text-primary">Centre de Formation</h1>
                        </Link>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex md:items-center md:space-x-8">
                        <Link
                            v-for="item in navigation"
                            :key="item.name"
                            :href="item.href"
                            :class="[
                                $page.url === item.href || $page.url.startsWith(item.href + '/')
                                    ? 'text-primary border-b-2 border-primary'
                                    : 'text-dark hover:text-primary',
                                'px-3 py-2 text-sm font-medium transition-colors'
                            ]"
                        >
                            {{ item.name }}
                        </Link>

                        <Link
                            v-if="page.props.auth.user"
                            :href="route('admin.dashboard')"
                            class="btn btn-primary"
                        >
                            Administration
                        </Link>
                        <Link
                            v-else
                            :href="route('login')"
                            class="btn btn-primary"
                        >
                            Connexion
                        </Link>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex items-center md:hidden">
                        <button
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                        >
                            <Bars3Icon v-if="!mobileMenuOpen" class="h-6 w-6" />
                            <XMarkIcon v-else class="h-6 w-6" />
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div v-show="mobileMenuOpen" class="md:hidden border-t border-gray-200">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        :class="[
                            $page.url === item.href
                                ? 'bg-primary-50 text-primary'
                                : 'text-dark hover:bg-gray-50',
                            'block px-3 py-2 rounded-md text-base font-medium'
                        ]"
                        @click="mobileMenuOpen = false"
                    >
                        {{ item.name }}
                    </Link>

                    <Link
                        v-if="page.props.auth.user"
                        :href="route('admin.dashboard')"
                        class="block w-full text-left px-3 py-2 btn btn-primary mt-4"
                    >
                        Administration
                    </Link>
                    <Link
                        v-else
                        :href="route('login')"
                        class="block w-full text-left px-3 py-2 btn btn-primary mt-4"
                    >
                        Connexion
                    </Link>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        <div v-if="page.props.flash?.success" class="bg-green-50 border-l-4 border-green-400 p-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-sm text-green-700">{{ page.props.flash.success }}</p>
            </div>
        </div>

        <!-- Main Content -->
        <main>
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-primary mb-4">Centre de Formation</h3>
                        <p class="text-gray-400 text-sm">
                            Votre partenaire pour développer vos compétences et réussir votre carrière professionnelle.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-4">Navigation</h4>
                        <ul class="space-y-2">
                            <li v-for="item in navigation" :key="item.name">
                                <Link :href="item.href" class="text-gray-400 hover:text-primary text-sm">
                                    {{ item.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-4">Contact</h4>
                        <ul class="space-y-2 text-gray-400 text-sm">
                            <li>Email: contact@centreformation.fr</li>
                            <li>Tél: 01 23 45 67 89</li>
                            <li>Adresse: 123 Rue de la Formation, Paris</li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                    <p>&copy; {{ new Date().getFullYear() }} Centre de Formation. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
