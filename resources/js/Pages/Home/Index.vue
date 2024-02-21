<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <GuestLayout
        class="shadow-sm"
        :canLogin="canLogin"
        :canRegister="canRegister"
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
                    CRM.
                </h1>
                <p
                    class="text-lg font-normal text-gray-500 lg:text-xl dark:text-gray-400"
                >
                    Here at Flowbite we focus on markets where technology,
                    innovation, and capital can unlock long-term value and drive
                    economic growth.
                </p>
            </div>

            <img
                class="h-auto transition-all duration-300 rounded-lg cursor-pointer w-5/12 shadow-2xl"
                src="https://cintakasihtzuchi.sch.id/wp-content/uploads/2018/11/coba-FILEminimizer-400x300.jpg"
                alt="image description"
            />
        </div>

        <div class="form-aspirations mb-16">
            <h2
                class="text-4xl font-extrabold text-center mb-5 dark:text-white"
            >
                <span class="text-blue-600 dark:text-blue-500">Aspiration</span>
                Form
            </h2>

            <hr
                class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700 w-2/4 mx-auto"
            />

            <form class="w-2/4 mx-auto">
                <div class="mb-5">
                    <label
                        for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Your email</label
                    >
                    <input
                        type="email"
                        id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="name@flowbite.com"
                        required
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Your password</label
                    >
                    <input
                        type="password"
                        id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required
                    />
                </div>
                <div class="flex items-start mb-5">
                    <div class="flex items-center h-5">
                        <input
                            id="remember"
                            type="checkbox"
                            value=""
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                            required
                        />
                    </div>
                    <label
                        for="remember"
                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Remember me</label
                    >
                </div>
                <button
                    type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Submit
                </button>
            </form>
        </div>
    </GuestLayout>
</template>
