<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    school_registration_number: '',
    school_address_location: '',
    school_facebook_link: '',
    school_instagram_link: '',
    school_twitter_link: '',
    school_website_link: '',
    school_logo: null, // File upload, optional
    school_motto: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <!-- Name -->
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <!-- School Registration Number -->
            <div class="mt-4">
                <InputLabel for="school_registration_number" value="School Registration Number" />
                <TextInput
                    id="school_registration_number"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.school_registration_number"
                    required
                />
                <InputError class="mt-2" :message="form.errors.school_registration_number" />
            </div>

            <!-- School Address -->
            <div class="mt-4">
                <InputLabel for="school_address_location" value="School Address" />
                <TextInput
                    id="school_address_location"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.school_address_location"
                    required
                />
                <InputError class="mt-2" :message="form.errors.school_address_location" />
            </div>

            <!-- Social Links (Facebook, Instagram, Twitter, Website) -->
            <div class="mt-4">
                <InputLabel for="school_facebook_link" value="Facebook Link" />
                <TextInput
                    id="school_facebook_link"
                    type="url"
                    class="mt-1 block w-full"
                    v-model="form.school_facebook_link"
                />
                <InputError class="mt-2" :message="form.errors.school_facebook_link" />
            </div>

            <div class="mt-4">
                <InputLabel for="school_instagram_link" value="Instagram Link" />
                <TextInput
                    id="school_instagram_link"
                    type="url"
                    class="mt-1 block w-full"
                    v-model="form.school_instagram_link"
                />
                <InputError class="mt-2" :message="form.errors.school_instagram_link" />
            </div>

            <div class="mt-4">
                <InputLabel for="school_twitter_link" value="Twitter Link" />
                <TextInput
                    id="school_twitter_link"
                    type="url"
                    class="mt-1 block w-full"
                    v-model="form.school_twitter_link"
                />
                <InputError class="mt-2" :message="form.errors.school_twitter_link" />
            </div>

            <div class="mt-4">
                <InputLabel for="school_website_link" value="Website Link" />
                <TextInput
                    id="school_website_link"
                    type="url"
                    class="mt-1 block w-full"
                    v-model="form.school_website_link"
                />
                <InputError class="mt-2" :message="form.errors.school_website_link" />
            </div>

            <!-- School Motto -->
            <div class="mt-4">
                <InputLabel for="school_motto" value="School Motto" />
                <TextInput
                    id="school_motto"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.school_motto"
                />
                <InputError class="mt-2" :message="form.errors.school_motto" />
            </div>

            <!-- School Logo (Optional) -->
            <div class="mt-4">
                <InputLabel for="school_logo" value="School Logo" />
                <input
                    id="school_logo"
                    type="file"
                    class="mt-1 block w-full"
                    @change="form.school_logo = $event.target.files[0]"
                    accept="image/*"
                />
                <InputError class="mt-2" :message="form.errors.school_logo" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
