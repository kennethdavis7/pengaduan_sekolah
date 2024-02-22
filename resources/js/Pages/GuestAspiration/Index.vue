<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import TextInput from "@/Components/TextInput.vue";
import Search from "@/Components/Search.vue";
import Flash from "@/Components/Flash.vue";
import { router } from "@inertiajs/vue3";
import { ref, watch, computed } from "vue";
import Select from "@/Components/Select.vue";

const props = defineProps({
    aspirations: Object,
    flash: Object,
    categories: Object,
    classes: Object,
    category_id: Number,
    class_id: Number,
    date: Date,
    canLogin: Boolean,
    canRegister: Boolean,
});

const categories = computed(() => [
    {
        id: -1,
        name: "All",
    },
    ...props.categories,
]);

const classes = computed(() => [
    {
        id: -1,
        name: "All",
    },
    ...props.classes,
]);

const search = ref();

const handleChangeCategory = (categoryId) => {
    const url = new URL(window.location.href);

    url.searchParams.set("category_id", categoryId);
    url.searchParams.set("page", "1");

    router.get(url, undefined, {
        preserveState: true,
    });
};

const handleChangeClass = (classId) => {
    const url = new URL(window.location.href);

    url.searchParams.set("class_id", classId);
    url.searchParams.set("page", "1");

    router.get(url, undefined, {
        preserveState: true,
    });
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

const date = ref(props.date);

watch(date, (value) => {
    const url = new URL(window.location.href);

    url.searchParams.set("date", value);
    url.searchParams.set("page", "1");

    router.get(url, undefined, {
        preserveState: true,
    });
});
</script>
<template>
    <Head title="Aspirations" />
    <GuestLayout
        class="shadow-sm"
        :canLogin="props.canLogin"
        :canRegister="props.canRegister"
    >
        <div class="mt-28"></div>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Aspirations
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
                        <div class="filter flex gap-4 items-center">
                            <TextInput
                                id="date"
                                type="date"
                                v-model="date"
                                class="w-full py-2 text-sm"
                            />
                            <Select
                                id="category_id"
                                :modelValue="category_id"
                                @update:modelValue="handleChangeCategory"
                                :data="categories"
                                popUpClass="w-96"
                                buttonClass="py-2"
                            />
                            <Select
                                id="class_id"
                                :modelValue="class_id"
                                @update:modelValue="handleChangeClass"
                                :data="
                                    classes.map((el) => {
                                        if (!el.hasOwnProperty('name')) {
                                            return {
                                                id: el.id,
                                                name: el.class,
                                            };
                                        }

                                        return el;
                                    })
                                "
                                popUpClass="w-96"
                                buttonClass="py-2"
                            />
                        </div>
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
                                        Class
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-center"
                                    >
                                        Category
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
                                        Date
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
                                    v-for="aspiration in props.aspirations.data"
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
                                        {{ aspiration.student_class }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ aspiration.category.name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            v-if="
                                                aspiration.status.name ===
                                                'Proses'
                                            "
                                            class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                                            >{{ aspiration.status.name }}</span
                                        >
                                        <span
                                            v-if="
                                                aspiration.status.name ===
                                                'Selesai'
                                            "
                                            class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"
                                            >{{ aspiration.status.name }}</span
                                        >
                                        <span
                                            v-if="
                                                aspiration.status.name ===
                                                'Menunggu'
                                            "
                                            class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                                            >{{ aspiration.status.name }}</span
                                        >
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{
                                            aspiration.created_at.split("T")[0]
                                        }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <Link
                                            :href="
                                                route(
                                                    'guestaspiration.show',
                                                    aspiration.id
                                                )
                                            "
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            >Detail</Link
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end">
                        <Pagination class="mt-4" :data="props.aspirations" />
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
