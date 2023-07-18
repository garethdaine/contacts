<template>
    <AppLayout title="Contacts">
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form @submit.prevent="createContact" class="space-y-6 px-6 md:px-0">
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900" for="first_name">
                        First Name
                    </label>
                    <div class="mt-2">
                        <input
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            id="first_name" type="text" v-model="form.first_name" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900" for="last_name">
                        Last Name
                    </label>
                    <div class="mt-2">
                        <input
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            id="last_name" type="text" v-model="form.last_name" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900" for="email">
                        Email
                    </label>
                    <div class="mt-2">
                        <input
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            id="email" type="email" v-model="form.email" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium leading-6 text-gray-900" for="telephone">
                        Telephone
                    </label>
                    <div class="mt-2">
                        <input
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            id="telephone" type="tel" v-model="form.telephone">
                    </div>
                </div>
                <div>
                    <button
                        class="bg-blue-500 hover:bg-blue-700 flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                        type="submit">
                        Create Contact
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Form {
    first_name: string;
    last_name: string;
    email: string;
    telephone: string;
}

const form = ref<Form>({
    first_name: '',
    last_name: '',
    email: '',
    telephone: '',
})

const createContact = (): void => {
    router.post('/contacts', form.value)
}
</script>
