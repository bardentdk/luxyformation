<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import {
    HomeIcon,
    DocumentTextIcon,
    AcademicCapIcon,
    DocumentDuplicateIcon,
    UsersIcon,
    Bars3Icon,
    XMarkIcon,
    ChevronDownIcon
} from '@heroicons/vue/24/outline';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';

const page = usePage();
const sidebarOpen = ref(false);

const navigation = [
    { name: 'Dashboard', href: '/admin/dashboard', icon: HomeIcon },
    { name: 'Utilisateurs', href: '/admin/users', icon: UsersIcon },
    { name: 'Blog', href: '/admin/posts', icon: DocumentTextIcon },
    { name: 'Formations', href: '/admin/formations', icon: AcademicCapIcon },
    { name: 'Pages', href: '/admin/pages', icon: DocumentDuplicateIcon },
];
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Mobile sidebar -->
        <div v-show="sidebarOpen" class="fixed inset-0 z-50 lg:hidden">
            <div class="fixed inset-0 bg-gray-900/80" @click="sidebarOpen = false"></div>
            <div class="fixed inset-y-0 left-0 w-72 bg-white">
                <div class="flex h-16 items-center justify-between px-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-primary">Admin</h2>
                    <button @click="sidebarOpen = false" class="text-gray-500 hover:text-gray-700">
                        <XMarkIcon class="h-6 w-6" />
                    </button>
                </div>
                <nav class="px-4 py-6 space-y-2">
                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        :class="[
                            $page.url.startsWith(item.href)
                                ? 'bg-primary text-white'
                                : 'text-gray-700 hover:bg-gray-100',
                            'group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors'
                        ]"
                    >
                        <component :is="item.icon" class="mr-3 h-5 w-5 flex-shrink-0" />
                        {{ item.name }}
                    </Link>
                </nav>
            </div>
        </div>

        <!-- Desktop sidebar -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-72 lg:flex-col">
            <div class="flex flex-col flex-grow bg-white border-r border-gray-200">
                <div class="flex h-16 items-center px-6 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-primary">Centre de Formation</h1>
                </div>
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <Link
                        v-for="item in navigation"
                        :key="item.name"
                        :href="item.href"
                        :class="[
                            $page.url.startsWith(item.href)
                                ? 'bg-primary text-white'
                                : 'text-gray-700 hover:bg-gray-100',
                            'group flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors'
                        ]"
                    >
                        <component :is="item.icon" class="mr-3 h-5 w-5 flex-shrink-0" />
                        {{ item.name }}
                    </Link>
                </nav>
            </div>
        </div>

        <!-- Main content -->
        <div class="lg:pl-72">
            <!-- Top bar -->
            <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 sm:gap-x-6 sm:px-6 lg:px-8">
                <button
                    type="button"
                    class="lg:hidden -m-2.5 p-2.5 text-gray-700"
                    @click="sidebarOpen = true"
                >
                    <Bars3Icon class="h-6 w-6" />
                </button>

                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <div class="flex flex-1"></div>
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative">
                            <MenuButton class="flex items-center gap-x-3 text-sm font-semibold text-gray-900">
                                <div class="h-10 w-10 rounded-full bg-primary flex items-center justify-center text-white font-semibold">
                                    {{ page.props.auth.user?.name?.charAt(0) || 'U' }}
                                </div>
                                <span class="hidden lg:block">{{ page.props.auth.user?.name }}</span>
                                <ChevronDownIcon class="h-5 w-5 text-gray-400" />
                            </MenuButton>
                            <transition
                                enter-active-class="transition ease-out duration-100"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95"
                            >
                                <MenuItems class="absolute right-0 z-10 mt-2.5 w-48 origin-top-right rounded-lg bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                                    <MenuItem v-slot="{ active }">
                                        <Link
                                            href="/profile"
                                            :class="[active ? 'bg-gray-50' : '', 'block px-4 py-2 text-sm text-gray-700']"
                                        >
                                            Profil
                                        </Link>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <Link
                                            href="/logout"
                                            method="post"
                                            as="button"
                                            :class="[active ? 'bg-gray-50' : '', 'block w-full text-left px-4 py-2 text-sm text-gray-700']"
                                        >
                                            Déconnexion
                                        </Link>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>

            <!-- Page content -->
            <main class="py-8 px-4 sm:px-6 lg:px-8">
                <!-- Flash messages -->
                <div v-if="page.props.flash?.success" class="mb-6 rounded-lg bg-green-50 p-4 border border-green-200">
                    <p class="text-sm font-medium text-green-800">{{ page.props.flash.success }}</p>
                </div>
                <div v-if="page.props.flash?.error" class="mb-6 rounded-lg bg-red-50 p-4 border border-red-200">
                    <p class="text-sm font-medium text-red-800">{{ page.props.flash.error }}</p>
                </div>

                <slot />
            </main>
        </div>
    </div>
</template>
