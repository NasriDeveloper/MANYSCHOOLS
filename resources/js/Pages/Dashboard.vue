<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3'; // Import Inertia Link

// Define a reactive variable to track the sidebar state (collapsed or expanded)
const sidebarOpen = ref(true);

// Function to toggle the sidebar
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

// Define your links dynamically
const links = [
    { name: 'Student Registration', href: '/student-registration' },
    { name: 'Parent Registration', href: '/parent-registration' },
    { name: 'Teacher Registration', href: '/teacher-registration' },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex min-h-screen bg-gray-100">
            <!-- Sidebar -->
            <aside
                :class="sidebarOpen ? 'w-64' : 'w-16'"
                class="bg-gray-800 text-gray-100 transition-all duration-300"
            >
                <!-- Sidebar Header -->
                <div class="h-16 flex items-center justify-between border-b border-gray-700 px-4">
                    <h1 :class="sidebarOpen ? 'block' : 'hidden'" class="text-2xl font-semibold">
                        Admin Panel
                    </h1>
                    <!-- Toggle button for sidebar -->
                    <button @click="toggleSidebar" class="text-gray-100 focus:outline-none">
                        <div class="w-6 h-6 bg-gray-300"></div>
                    </button>
                </div>

                <!-- Sidebar Navigation Links -->
                <nav class="mt-10">
                    <Link
                        v-for="link in links"
                        :key="link.name"
                        :href="link.href"
                        class="block px-4 py-2 text-lg font-bold hover:bg-gray-700"
                        :class="sidebarOpen ? 'block' : 'hidden'"
                    >
                        {{ link.name }}
                    </Link>
                </nav>
            </aside>

            <!-- Main content area -->
            <div class="flex-1">
                <div class="py-12">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                You're logged in!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
