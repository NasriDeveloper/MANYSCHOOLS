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

// Form data and validation
const teacher = ref({
    teacher_name: '',
    teacher_email: '',
    teacher_password: '',
    teacher_role: '',
    
});

// Form submission function
const submitForm = () => {
    // Handle form submission logic (e.g., send to server)
    console.log('Form submitted:', teacher.value);
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
                                <h2 class="text-xl font-bold mb-4">Teacher's Registration</h2>
                                <form @submit.prevent="submitForm">
                                    <div class="grid grid-cols-1 gap-4">
                                        <!-- Teacher Name -->
                                        <div>
                                            <label for="teacher_name" class="block text-sm font-medium text-gray-700">Name</label>
                                            <input
                                                v-model="teacher.teacher_name"
                                                type="text"
                                                id="teacher_name"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                                required
                                            />
                                        </div>
                                        
                                        <!-- Teacher Email -->
                                        <div>
                                            <label for="teacher_email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input
                                                v-model="teacher.teacher_email"
                                                type="email"
                                                id="teacher_email"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                                required
                                            />
                                        </div>
                                        
                                        <!-- Teacher Password -->
                                        <div>
                                            <label for="teacher_password" class="block text-sm font-medium text-gray-700">Password</label>
                                            <input
                                                v-model="teacher.teacher_password"
                                                type="password"
                                                id="teacher_password"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                                required
                                            />
                                        </div>
                                        
                                        <!-- Teacher Role -->
                                        <div>
                                            <label for="teacher_role" class="block text-sm font-medium text-gray-700">Role</label>
                                            <input
                                                v-model="teacher.teacher_role"
                                                type="text"
                                                id="teacher_role"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                                required
                                            />
                                        </div>
                                        
                                        <!-- Teacher Photo -->
                                      
                                    </div>
                                    <div class="mt-4">
                                        <button
                                            type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200"
                                        >
                                            Register Teacher
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
