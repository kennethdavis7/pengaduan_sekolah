<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link, router } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Pagination from "@/Components/Pagination.vue";
import Flash from "@/Components/Flash.vue";
import Search from "@/Components/Search.vue";
import { ref, watch } from "vue";

const props = defineProps({
    categories: Object,
    flash: Object,
});

const search = ref();

const handleDelete = (value) => {
    router.delete(route("categories.destroy", value));
};

let searchTimeout = null;

watch(search, (value) => {
    if (searchTimeout !== null) {
        clearTimeout(searchTimeout);
        searchTimeout = null;
    }

    searchTimeout = setTimeout(() => {
        const url = new URL(window.location.href);

        url.searchParams.set("search", value);
        url.searchParams.set("page", "1");

        router.get(url, undefined, {
            preserveState: true,
        });
    }, 250);
});
</script>
<template>
    <Head title="Categories" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Flash
                    :message="props.flash.message"
                    v-if="props.flash.message"
                />
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <div class="flex justify-between items-center mb-5">
                        <Search class="w-56" v-model="search" />
                        <Link :href="route('categories.create')">
                            <PrimaryButton class="px-4 py-2">
                                Create
                            </PrimaryButton>
                        </Link>
                    </div>
                    <div
                        class="relative overflow-x-auto shadow-md sm:rounded-lg"
                    >
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        No
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                    v-for="category in props.categories.data"
                                    :key="category.id"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                    >
                                        {{ category.id }}
                                    </th>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                    >
                                        {{ category.name }}
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        <Link
                                            :href="
                                                route(
                                                    'categories.edit',
                                                    category.id
                                                )
                                            "
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-5"
                                            >Edit</Link
                                        >
                                        <button
                                            @click="
                                                () => handleDelete(category.id)
                                            "
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end">
                        <Pagination class="mt-4" :data="props.categories" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
