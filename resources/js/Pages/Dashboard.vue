<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'; // Import the layout

// Define a reactive variable to track the sidebar state (collapsed or expanded)
const sidebarOpen = ref(true);

// Function to toggle the sidebar
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};
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
                        <!-- Icon for toggling (you can replace this with an icon) -->
                        <div class="w-6 h-6 bg-gray-300"></div>
                    </button>
                </div>

                <!-- Sidebar Navigation Links -->
                <nav class="mt-10">
                    <a
                        v-for="n in 7"
                        :key="n"
                        href="#"
                        class="block px-4 py-2 text-sm hover:bg-gray-700"
                        :class="sidebarOpen ? 'block' : 'hidden'"
                    >
                        Registration {{ n }}
                    </a>
                </nav>
            </aside>

            <!-- Main content area -->
            <div class="flex-1">
                <!-- Profile and Logout Links (Inertia's Authenticated Layout ensures these work) -->
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
