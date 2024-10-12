<template>
    <AuthenticatedLayout title="Teachers List">
        <div class="flex min-h-screen bg-gray-100">
            <!-- Sidebar -->
            <aside 
                :class="sidebarOpen ? 'w-64' : 'w-16'" 
                class="bg-gray-800 text-gray-100 transition-all duration-300"
            >
                <div class="h-16 flex items-center justify-between border-b border-gray-700 px-4">
                    <h1 :class="sidebarOpen ? 'block' : 'hidden'" class="text-2xl font-semibold">
                        Admin Panel
                    </h1>
                    <button @click="toggleSidebar" class="text-gray-100 focus:outline-none">
                        <div class="w-6 h-6 bg-gray-300"></div>
                    </button>
                </div>

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

            <!-- Main Content -->
            <div class="flex-1 py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-bold mb-4">Teacher Details</h3>

                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="teacher in teachers" :key="teacher.id">
                                        <td class="px-6 py-4">{{ teacher.teacher_name }}</td>
                                        <td class="px-6 py-4">{{ teacher.teacher_email }}</td>
                                        <td class="px-6 py-4">{{ teacher.role }}</td>
                                        <td class="px-6 py-4">
                                            <button 
                                                @click.prevent="editTeacher(teacher.id)" 
                                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                            >
                                                Edit
                                            </button>
                                            <button 
                                                @click.prevent="deleteTeacher(teacher.id)" 
                                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 ml-2"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Sidebar state
const sidebarOpen = ref(true);
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

// Links for the sidebar navigation
const links = [
    { name: 'Student Registration', href: '/student-registration' },
    { name: 'Parent Registration', href: '/parent-registration' },
    { name: 'Teacher Registration', href: '/teacher-registration' },
    { name: 'Teachers List', href: '/view-teachers' },
];

// Receive teachers data as props
const props = defineProps({
    teachers: Array,
});

// Navigate to the edit teacher page
const editTeacher = (id) => {
    router.get(`/teachers/${id}/edit`);
};

// Handle teacher deletion
const deleteTeacher = (id) => {
    router.delete(`/teachers/${id}`, {
        onSuccess: () => {
            alert('Teacher deleted successfully!');
        },
        onError: (errors) => {
            console.error('Failed to delete teacher:', errors);
            alert('Unable to delete teacher.');
        },
    });
};
</script>
