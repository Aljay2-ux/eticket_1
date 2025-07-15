<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { reactive } from "vue";

const { props } = usePage();

import { createInertiaApp, Head, router, Link } from "@inertiajs/vue3";

const page = usePage();

const form = reactive({
    description_of_request: "",
    ict_service_request_type_id: "",
    ict_inventory_id: props.asset_id,
    requested_by: props.auth.user.name,
    created_by: props.auth.user.id,
});

// Function to submit the form
const submit_h1 = () => {
    router.get("/request/defect/date", {
        description_of_request: form.description_of_request,
        ict_service_request_type_id: form.ict_service_request_type_id,
        asset_id: props.asset_id,
        requested_by: props.auth.user.name,
        created_by: props.auth.user.id,
    });
};
</script>
<template>
    <UserLayout>
        <div class="w-[calc(100%+8rem)] space-y-6 lg:space-y-8">
            <!-- stop -->

            <div class="space-y-4 w-96">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Recomendation(s):
                </h3>

                <!-- <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select your
                    service requested</label>
                <select v-model="form.ict_service_request_type_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option v-for="request_type in props.ict_service_request_type_id" :key="request_type.id" :value="request_type.id">
                        {{ request_type.name }}
                    </option>
                </select> -->

                <div
                    class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700"
                >
                    <input
                        id="bordered-checkbox-1"
                        type="checkbox"
                        value=""
                        name="bordered-checkbox"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    />
                    <label
                        for="bordered-checkbox-1"
                        class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Need Parts</label
                    >
                </div>
                <div
                    class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700"
                >
                    <input
                        checked
                        id="bordered-checkbox-2"
                        type="checkbox"
                        value=""
                        name="bordered-checkbox"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    />
                    <label
                        for="bordered-checkbox-2"
                        class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        >Need Software</label
                    >
                </div>
            </div>
            <div>
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Unit Status:</label>
                <select v-model="form.ict_service_request_type_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option v-for="request_type in props.ict_service_request_type_id" :key="request_type.id" :value="request_type.id">
                        {{ request_type.name }}
                    </option>
                </select>
            </div>
            <div >
            <span>Detailed Descriptions of Works / Findings:</span>
            </div>
            <div
                class="flex items-center gap-8 p-6 sm:items-start lg:items-center"
                v-for="asset in props.assets"
                :key="asset.id"
            >
                <div class="min-w-0 flex-1 gap-14 xl:flex xl:items-center">
                    <div
                        class="min-w-0 max-w-xl flex-1 gap-6 sm:flex sm:items-center"
                    >
                        <a
                            href="/request/defect"
                            class="mb-4 flex aspect-square h-14 w-14 shrink-0 items-center sm:mb-0"
                        >
                            <img
                                class="h-auto max-h-full w-full dark:hidden"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg"
                                alt="imac image"
                            />
                            <img
                                class="hidden h-auto max-h-full w-full dark:block"
                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg"
                                alt="imac image"
                            />
                        </a>
                        <a
                            href="#"
                            class="mt-4 font-medium text-gray-900 hover:underline dark:text-white sm:mt-0"
                        >
                            {{ asset.equipment_type }}</a
                        >
                    </div>

                    
                </div>
            </div>

            <div
                class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600"
            >
                
                <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
                    <label for="description_of_request" class="sr-only"
                        >Publish post</label
                    >
                    <textarea
                        id="description_of_request"
                        v-model="form.description_of_request"
                        rows="8"
                        class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                        placeholder="Write an article..."
                    ></textarea>
                </div>
            </div>

            

            <div class="flex justify-between">
                <!-- Previous Button -->
                <Link
                    :href="route('technician.dashboard')"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800"
                >
                    Cancel
            </Link>

                <!-- Next Button -->
                <Link :href="route('technician.dashboard')"
                    type="button"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800"
                >
                    Submit
            </Link>
            </div>
        </div>
    </UserLayout>
</template>
