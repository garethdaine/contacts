<template>
    <AppLayout title="Contacts">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-6">
                <input v-model="search" @keyup.enter="updateSearch"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    type="text" placeholder="Search contacts..." />
                <Link href="/contacts/create"
                    class="bg-blue-500 hover:bg-blue-700 flex ml-4 justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                New
                </Link>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        First Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Last
                                        Name
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Telephone
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="contact in contacts.data" :key="contact.id">
                                    <td class="whitespace-nowrap py-4 pl-5 pr-3 text-sm font-medium text-gray-900">
                                        {{
                                            contact.first_name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">{{
                                        contact.last_name }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ contact.email }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ contact.telephone }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
                            aria-label="Pagination">
                            <div class="hidden sm:block">
                                <p class="text-sm text-gray-700">
                                    Showing
                                    {{ ' ' }}
                                    <span class="font-medium">{{ contacts.from }}</span>
                                    {{ ' ' }}
                                    to
                                    {{ ' ' }}
                                    <span class="font-medium">{{ contacts.to }}</span>
                                    {{ ' ' }}
                                    of
                                    {{ ' ' }}
                                    <span class="font-medium">{{ contacts.total }}</span>
                                    {{ ' ' }}
                                    results
                                </p>
                            </div>
                            <div class="flex flex-1 justify-between sm:justify-end">
                                <a v-if="contacts.prev_page_url" :href="contacts.prev_page_url"
                                    class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Previous</a>
                                <a v-if="contacts.next_page_url" :href="contacts.next_page_url"
                                    class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Next</a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script lang="ts" setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

interface Contact {
    id: number
    first_name: string
    last_name: string
    email: string
    telephone: string
}

let { contacts } = usePage<{ contacts: Contact[] }>().props
const search = ref('')

const updateSearch = () => {
    router.get('/contacts', { search: search.value })
}

const query = usePage().props.ziggy.query

onMounted(() => {
    if (query.search) {
        search.value = query.search as string
    }
})
</script>
