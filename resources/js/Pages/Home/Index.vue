<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Select from "@/Components/Select.vue";
import { QuillEditor } from "@vueup/vue-quill";
import Flash from "@/Components/Flash.vue";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    classes: Object,
    categories: Object,
    flash: Object,
});

const form = useForm({
    name: "",
    nisn: "",
    class_id: props.classes[0].id,
    location: "",
    description: "",
    category_id: props.categories[0].id,
    image: null,
});

const submit = () => {
    form.post(route("aspirations.store"));
};
</script>

<template>
    <GuestLayout
        class="shadow-sm"
        :canLogin="props.canLogin"
        :canRegister="props.canRegister"
    >
        <div class="flex justify-between w-full p-36 mb-16">
            <div class="heading mr-20">
                <h1
                    class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white"
                >
                    Get back to growth with
                    <span class="text-blue-600 dark:text-blue-500"
                        >the world's #1</span
                    >
                    School
                </h1>
                <p
                    class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400"
                >
                    See the aspirations from students expressed passionately,
                    eloquently, and with fervor.
                </p>
            </div>

            <img
                class="h-auto transition-all duration-300 rounded-lg cursor-pointer w-5/12 shadow-2xl"
                src="https://cintakasihtzuchi.sch.id/wp-content/uploads/2018/11/coba-FILEminimizer-400x300.jpg"
                alt="image description"
            />
        </div>

        <div class="form-aspirations mb-16">
            <Flash
                :message="props.flash.message"
                v-if="props.flash.message"
                class="w-2/4 mx-auto mb-4"
            />
            <h2
                class="text-4xl font-extrabold text-center mb-5 dark:text-white"
            >
                <span class="text-blue-600 dark:text-blue-500">Aspiration</span>
                Form
            </h2>

            <hr
                class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700 w-2/4 mx-auto"
            />

            <form @submit.prevent="submit" class="w-2/4 mx-auto">
                <div class="mb-5">
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="name"
                        class="mt-1 block border border-gray-200 w-full px-2 py-2"
                        v-model="form.name"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mb-5">
                    <InputLabel for="nisn" value="NISN" />

                    <TextInput
                        id="nisn"
                        type="nisn"
                        class="mt-1 block border border-gray-200 w-full px-2 py-2"
                        v-model="form.nisn"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.nisn" />
                </div>
                <div class="mb-5">
                    <InputLabel for="location" value="Location" />

                    <TextInput
                        id="location"
                        type="location"
                        class="mt-1 block border border-gray-200 w-full px-2 py-2"
                        v-model="form.location"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.location" />
                </div>
                <div class="mb-5 flex gap-4">
                    <div class="class-input w-2/4">
                        <InputLabel for="class" value="Class" />

                        <Select
                            id="class_id"
                            v-model="form.class_id"
                            :data="
                                classes.map((el) => {
                                    return {
                                        id: el.id,
                                        name: el.class,
                                    };
                                })
                            "
                            popupClass="w-full"
                            buttonClass="py-3 w-full"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.class_id"
                        />
                    </div>
                    <div class="category-input w-2/4">
                        <InputLabel for="category" value="Category" />

                        <Select
                            id="category_id"
                            v-model="form.category_id"
                            :data="props.categories"
                            popupClass="w-full"
                            buttonClass="py-3 w-full"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.category_id"
                        />
                    </div>
                </div>

                <div class="mb-5">
                    <InputLabel for="image" value="Image" />
                    <input
                        class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
                        type="file"
                        @input="form.image = $event.target.files[0]"
                        id="image"
                    />
                </div>

                <div class="mb-7">
                    <InputLabel
                        for="description"
                        class="mb-2"
                        value="Description"
                    />

                    <QuillEditor
                        v-model:content="form.description"
                        contentType="html"
                        theme="snow"
                    />

                    <InputError class="mt-2" />
                </div>

                <PrimaryButton
                    class="px-6 py-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Send
                </PrimaryButton>
            </form>
        </div>
    </GuestLayout>
</template>
