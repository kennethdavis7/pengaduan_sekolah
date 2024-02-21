<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Select from "@/Components/Select.vue";
</script>
<template>
    <Head title="Aspirations" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl bg-white mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5"
                >
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <InputLabel for="feedback" value="feedback" />

                            <TextInput
                                id=""
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <InputLabel for="status" value="status" />
                            <Select
                                id="category_id"
                                v-model="form.status"
                                popupClass="w-full"
                                buttonClass="py-3"
                            />
                            <InputError class="mt-2" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
