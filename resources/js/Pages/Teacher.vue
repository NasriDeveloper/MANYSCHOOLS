<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3'; 
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import Sidebar from "./Sidebar.vue";

// Sidebar state
const sidebarOpen = ref(true);
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

// Navigation links
const links = [
    { name: 'Student Registration', href: '/student-registration' },
    { name: 'Parent Registration', href: '/parent-registration' },
    { name: 'Teacher Registration', href: '/teacher-registration' },
    { name: 'Teachers List', href: '/view-teachers' },
];

// Teacher form data and success message
const formData = ref({
    teacher_name: '',
    teacher_email: '',
    teacher_password: '',
    teacher_role: '',
    user_id: '', // Initialize user_id
});
const successMessage = ref('');

// Get the user_id passed as prop
const props = defineProps({
    user_id: Number,
});

// Set the user_id in form data
formData.value.user_id = props.user_id;

// Handle form submission
const submitForm = async () => {
    try {
        let form = new FormData();
        for (let key in formData.value) {
            form.append(key, formData.value[key]);
        }

        await router.post('/teacher-reg', form, {
            onSuccess: () => {
                successMessage.value = 'Teacher registered successfully!';
                resetForm();
            },
            onError: (errors) => {
                console.error('Error:', errors);
                alert('Failed to register teacher. Please check the form.');
            },
        });
    } catch (error) {
        console.error('Submission error:', error);
    }
};

// Reset form data
const resetForm = () => {
    formData.value = {
        teacher_name: '',
        teacher_email: '',
        teacher_password: '',
        teacher_role: '',
        user_id: props.user_id, // Reset user_id
    };
};

// Close success message
const closeSuccessMessage = () => {
    successMessage.value = '';
};
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="flex min-h-screen bg-gray-100">
            <!-- Sidebar -->
            <Sidebar />

            <!-- Main Content -->
            <div class="flex-1">
                <div class="py-12">
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <h2 class="text-xl font-bold mb-4">Teacher's Registration</h2>

                                <form @submit.prevent="submitForm">
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label for="teacher_name" class="block text-sm font-medium text-gray-700">Name</label>
                                            <input
                                                v-model="formData.teacher_name"
                                                type="text"
                                                id="teacher_name"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                                required
                                            />
                                        </div>

                                        <div>
                                            <label for="teacher_email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input
                                                v-model="formData.teacher_email"
                                                type="email"
                                                id="teacher_email"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                                required
                                            />
                                        </div>

                                        <div>
                                            <label for="teacher_password" class="block text-sm font-medium text-gray-700">Password</label>
                                            <input
                                                v-model="formData.teacher_password"
                                                type="password"
                                                id="teacher_password"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                                required
                                            />
                                        </div>

                                        <div>
                                            <label for="teacher_role" class="block text-sm font-medium text-gray-700">Role</label>
                                            <select
                                                v-model="formData.teacher_role"
                                                id="teacher_role"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                                required
                                            >
                                                <option value="none">None</option>
                                                <option v-for="n in 7" :key="n" :value="'class ' + n">
                                                    Class {{ n }}
                                                </option>
                                            </select>
                                        </div>
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

        <!-- Success Message Modal -->
        <transition name="fade">
            <div v-if="successMessage" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold">Success</h3>
                    <p class="mt-2">{{ successMessage }}</p>
                    <button @click="closeSuccessMessage" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Close
                    </button>
                </div>
            </div>
        </transition>
    </AuthenticatedLayout>
</template>

<style>
.alert {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 0.25rem;
}

.close {
    background: transparent;
    border: none;
    cursor: pointer;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
    opacity: 0;
}
</style>
