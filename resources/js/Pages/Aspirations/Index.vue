<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Search from "@/Components/Search.vue";

const props = defineProps(["aspirations"]);
</script>
<template>
    <Head title="Aspirations" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Aspirations
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5"
                >
                    <div class="flex justify-between items-center mb-5">
                        <Search />
                        <Link :href="route('aspirations.create')">
                            <PrimaryButton> Create </PrimaryButton>
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
                                        Image
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        Student Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        NISN
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        Description
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        Status
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        Feedback
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
                                    v-for="aspiration in props.aspirations"
                                    :key="aspiration.id"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                    >
                                        {{ aspiration.id }}
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        <img
                                            :src="aspiration.image_url"
                                            alt=""
                                            class="w-20"
                                        />
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ aspiration.student.name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ aspiration.student.nisn }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ aspiration.description }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            v-if="
                                                aspiration.status === 'Proses'
                                            "
                                            class="'bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300',"
                                            >{{ aspiration.status }}</span
                                        >
                                        <span
                                            v-if="
                                                aspiration.status === 'Selesai'
                                            "
                                            class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"
                                            >{{ aspiration.status }}</span
                                        >
                                        <span
                                            v-if="
                                                aspiration.status === 'Menunggu'
                                            "
                                            class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                                            >{{ aspiration.status }}</span
                                        >
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ aspiration.feedback }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <Link
                                            href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-5"
                                            >Edit</Link
                                        >
                                        <Link
                                            href="#"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                            >Delete</Link
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
