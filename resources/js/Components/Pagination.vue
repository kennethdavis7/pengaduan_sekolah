<script setup>
import { router } from "@inertiajs/vue3";

const props = defineProps(["data"]);

const handleSelectPage = (url) => {
    router.get(url, undefined, {
        replace: true,
        preserveScroll: true,
        onSuccess: () => {
            setTimeout(() => {
                window.scrollBy({
                    top: document.body.scrollHeight,
                });
            }, 50);
        },
    });
};
</script>
<template>
    <nav class="flex justify-between">
        <ul class="inline-flex text-base">
            <template v-for="link in data.links" :key="link.label">
                <li>
                    <button
                        type="button"
                        :class="[
                            'flex items-center justify-center px-3 h-8 border border-gray-300 dark:border-gray-700',
                            link.active
                                ? 'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-700 dark:text-white'
                                : 'leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
                        ]"
                        @click="() => handleSelectPage(link.url)"
                    >
                        <span v-html="link.label"></span>
                    </button>
                </li>
            </template>
        </ul>
    </nav>
</template>
