<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Select from "@/Components/Select.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const props = defineProps(["aspiration", "statuses"]);

const form = useForm({
    feedback: props.aspiration.feedback,
    status_id: props.aspiration.status.id,
});

const submit = () => {
    form.put(route("aspirations.update", props.aspiration.id));
};
</script>
<template>
    <Head :title="'Aspirations ' + props.aspiration.id" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl bg-white mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <h2
                        class="font-semibold text-4xl text-gray-800 leading-tight"
                    >
                        Aspiration -
                        {{ props.aspiration.id }}
                    </h2>
                    <hr
                        class="h-px mt-4 mb-7 bg-gray-200 border-0 dark:bg-gray-700"
                    />
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <InputLabel
                                for="status"
                                class="mb-2"
                                value="Status"
                            />
                            <Select
                                id="status"
                                class="w-56"
                                v-model="form.status_id"
                                :data="props.statuses"
                                popupClass="w-56"
                                buttonClass="py-3"
                            />
                            <InputError class="mt-2" />
                        </div>

                        <div class="mb-7">
                            <InputLabel
                                for="feedback"
                                class="mb-2"
                                value="Feedback"
                            />

                            <QuillEditor
                                v-model:content="form.feedback"
                                contentType="html"
                                theme="snow"
                            />

                            <InputError class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <PrimaryButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Send to {{ props.aspiration.student.name }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
