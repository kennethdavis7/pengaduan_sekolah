<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps(["aspiration", "canLogin", "canRegister"]);
</script>
<template>
    <Head :title="'Detail Aspiration ' + props.aspiration.id" />
    <GuestLayout
        class="shadow-sm"
        :canLogin="props.canLogin"
        :canRegister="props.canRegister"
    >
        <div class="py-12 mt-28">
            <div class="max-w-7xl bg-white mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <div class="flex justify-between items-end">
                        <h2
                            class="font-semibold text-4xl text-gray-800 leading-tight"
                        >
                            Aspiration -
                            {{ props.aspiration.id }}
                        </h2>
                        <span> From {{ props.aspiration.student.name }} </span>
                    </div>
                    <hr
                        class="h-px mt-4 mb-7 bg-gray-200 border-0 dark:bg-gray-700"
                    />

                    <div class="flex">
                        <img
                            class="h-auto max-w-full mr-5 w-2/4"
                            :src="'/' + props.aspiration.image_url"
                            alt="image description"
                        />

                        <div class="side-content w-full">
                            <div class="my-3">
                                <div class="mb-6">
                                    <span class="text-gray-500">
                                        Description
                                    </span>
                                    <hr
                                        class="h-px mt-2 bg-gray-200 border-0 dark:bg-gray-700"
                                    />
                                    <p
                                        class="mt-3"
                                        v-html="props.aspiration.description"
                                    ></p>
                                </div>
                                <div>
                                    <span class="text-gray-500">
                                        Feedback
                                    </span>
                                    <hr
                                        class="h-px mt-2 bg-gray-200 border-0 dark:bg-gray-700"
                                    />
                                    <p
                                        class="mt-3"
                                        v-html="props.aspiration.feedback"
                                    ></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
