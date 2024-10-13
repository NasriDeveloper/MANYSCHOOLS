<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3'; // Import Inertia Link
import Sidebar from "./Sidebar.vue";

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
    { name: 'Teachers List', href: '/view-teachers' },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex min-h-screen bg-gray-100">
            <!-- Sidebar -->
            <Sidebar />

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
