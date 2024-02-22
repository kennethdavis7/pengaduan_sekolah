<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps(["category"]);

const form = useForm({
    name: props.category.name,
});

const submit = () => {
    form.put(route("categories.update", props.category.id));
};
</script>
<template>
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl bg-white mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-5">
                    <h2
                        class="font-semibold text-4xl text-gray-800 leading-tight"
                    >
                        Edit Category
                    </h2>
                    <hr
                        class="h-px mt-4 mb-7 bg-gray-200 border-0 dark:bg-gray-700"
                    />
                    <form @submit.prevent="submit" class="mb-4">
                        <div class="mb-4">
                            <InputLabel for="name" value="Name" />

                            <TextInput
                                id="name"
                                type="name"
                                class="mt-1 block border border-gray-200 w-full px-2 py-2"
                                v-model="form.name"
                                required
                                autofocus
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                        </div>
                        <div class="mb-4">
                            <PrimaryButton
                                class="px-6 py-3"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Edit
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
