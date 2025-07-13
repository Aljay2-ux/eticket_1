<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import Pagination from "./Pagination.vue";
import { usePage, router, Link } from "@inertiajs/vue3";

import axios from 'axios';
const dialogVisible = ref(false);
const dialogVisible1 = ref(false);
const { props } = usePage();

import { ref, onMounted } from 'vue';

let submit = () => {
    router.post("/status");
};

const fetchTickets = async () => {
    try {
        const response = await axios.get('/user/dashboard'); // Adjust the endpoint as needed
        tickets.value = response.data;
    } catch (error) {
        console.error("Error fetching tickets:", error);
    }
};

onMounted(fetchTickets);

const can = usePage(() => props.auth.can);
const viewing = () => {
    router.get("/request/viewing");
};
</script>
<template>
    <UserLayout>


        <div class="relative shadow-md sm:rounded-lg">
            <div
                class="flex flex-column sm:flex-row flex-wrap space-y-2 sm:space-y-0 items-center justify-between pb-4">
                <div class="space-x-6 mb-2">
                    <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">
                        <svg class="w-4 h-6 text-gray-500 dark:text-gray-400 me-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                        </svg>
                        Last 30 days
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <Link :href="route('request')" type="button"
                        class="py-2 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">
                    Add</Link>
                    <!-- Dropdown menu -->
                    <div id="dropdownRadio"
                        class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="
                            position: absolute;
                            inset: auto auto 0px 0px;
                            margin: 0px;
                            transform: translate3d(522.5px, 3847.5px, 0px);
                        ">
                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownRadioButton">
                            <li>
                                <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="filter-radio-example-1" type="radio" value="" name="filter-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <label for="filter-radio-example-1"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                        day</label>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input checked="" id="filter-radio-example-2" type="radio" value=""
                                        name="filter-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <label for="filter-radio-example-2"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                        7 days</label>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="filter-radio-example-3" type="radio" value="" name="filter-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <label for="filter-radio-example-3"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                        30 days</label>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="filter-radio-example-4" type="radio" value="" name="filter-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <label for="filter-radio-example-4"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                        month</label>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input id="filter-radio-example-5" type="radio" value="" name="filter-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                                    <label for="filter-radio-example-5"
                                        class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last
                                        year</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative ms-6">
                    <div
                        class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for items" />
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 w-[calc(70%+8rem)]">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Ticket #</th>
                            <th scope="col" class="px-6 py-3">Equipment Type</th>
                            <th scope="col" class="px-6 py-3">Request Type</th>
                            <th scope="col" class="px-6 py-3">Remarks</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <!-- <div>
                                <th scope="col" class="px-6 py-3">
                                Description of Request
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date Requested
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date Completed
                            </th>
                            <th scope="col" class="px-6 py-3">Date Needed</th>
                            <th scope="col" class="px-6 py-3">
                                Description of Work
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description of Findings
                            </th>
                            <th scope="col" class="px-6 py-3">Remarks</th>
                            <th scope="col" class="px-6 py-3">Technician</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            </div> -->
                            <th scope="col" class=" px-10  py-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                            v-for="assets_1 in props.tickets.data" :key="assets_1.id">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ assets_1.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ assets_1.ict_inventory.ict_equipment_type.name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ assets_1.request_type.name }}
                            </td>

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ assets_1.remarks }}
                            </th>
                            <td class="px-6 py-4">
                                {{ assets_1.ict_request_status.name }}
                            </td>

                            <!-- <td class=" px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</a>
                </td> -->
                            <td class="px-5 py-2">
                                <!-- <button @click="viewing">
                                    <img
                                        class="w-1/2"
                                        src="https://cdn-icons-png.flaticon.com/128/709/709612.png"
                                    />
                                </button>
                            </td>
                            <td
                                class="flex flex-row p-4 border-slate-200 justify-center px-6 py-4"
                            >
                                <button
                                    class="relative min-w-full h-10 w-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-slate-900 transition-all hover:bg-slate-900/10 active:bg-slate-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button"
                                >
                                    <span
                                        class="flex flex-row space-x-1 absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="blue"
                                            aria-hidden="true"
                                            class="w-4 h-4"
                                        >
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"
                                            ></path>
                                        </svg>
                                        <a class="space-x-4 text-blue-600">
                                            edit
                                        </a>
                                    </span>
                                </button> -->

                                <el-button plain @click="dialogVisible1 = true">
                                    View Details
                                </el-button>
                                <button v-if="props.can.deleteUser"
                                    class="relative min-w-full h-10 w-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-slate-900 transition-all hover:bg-slate-900/10 active:bg-slate-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    <span
                                        class="flex flex-row justify-center space-x-1 absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        <img class="h-4"
                                            src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" />
                                        <a class="space-x-4 text-red-600">
                                            DELETE
                                        </a>
                                    </span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <el-dialog v-model="dialogVisible1" :modal="false" :width="600" :show-close="false">
                    <template #header="{ close, titleId, titleClass }">
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Request Details
                            </h3>
                            <button @click="close" type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="crud-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                    </template>
                    <!-- component -->


                    <!-- component -->
                    <!-- component -->
                    <!-- This is an example component -->

                    <!-- <div class="flex flex-wrap">
                        <div
                            class="w-full max-w-lg bg-white dark:bg-gray-800 border-gray-200 border dark:border-gray-700 shadow-sm rounded-lg p-5">
                            <div>
                            <label for="account-id"
                                class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Requested_by:</label>
                            </div>
                                <div class="relative mb-4">
                                <input id="account-id" type="text"
                                    class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="756593826" disabled readonly>
                            </div>
                            <label for="api-key"
                                class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Department/Unit:</label>
                            <div class="relative mb-4">
                                <input id="api-key" type="text"
                                    class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="f4h6sd3t-jsy63ind-hsgdt7rs-jdhf76st" disabled readonly>
                            </div>
                            <label for="role-arn"
                                class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Date:</label>
                            <div class="relative mb-6">
                                <input id="role-arn" type="text"
                                    class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="123456789012:user/Flowbite" disabled readonly>
                            </div>
                            <label for="role-arn"
                                class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Date_needed:</label>
                            <div class="relative mb-6">
                                <input id="role-arn" type="text"
                                    class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="123456789012:user/Flowbite" disabled readonly>
                            </div>
                            <label for="role-arn"
                                class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Request
                                Description:</label>
                            <div class="relative mb-6">
                                <input id="role-arn" type="text"
                                    class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="123456789012:user/Flowbite" disabled readonly>
                            </div>
                            <label for="role-arn"
                                class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Request
                                Type:</label>
                            <div class="relative mb-6">
                                <input id="role-arn" type="text"
                                    class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="123456789012:user/Flowbite" disabled readonly>
                            </div>

                        </div>
                    </div> -->

                    <div class="md:flex ">
                        <div class="md:pr-3 md:min-w-64 space-x-4">
                            <span class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Requested
                                By:</span>
                        </div>
                        <div class="px-6">
                            <span class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Date and Time
                                Requested:</span>
                        </div>
                    </div>
                    <div class="flex space-x-6 w-full">
                        <div
                            class=" bg-white  dark:bg-gray-800 border-gray-300 border dark:border-gray-700 shadow-sm rounded-sm p-2 w-64">
                            hey</div>

                        <div
                            class="gap-2.5 bg-white  dark:bg-gray-800 border-gray-300 border dark:border-gray-700 shadow-sm rounded-sm p-2 w-1/2">
                            hey</div>
                    </div>
                    <div class="py-6">
                        <div class="md:flex ">
                            <div class="md:pr-3 md:min-w-64 space-x-4">
                                <span class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Deparment/
                                    Unit:</span>
                            </div>
                            <div class="px-6">
                                <span class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Date
                                    Needed:</span>
                            </div>
                        </div>
                        <div class="flex space-x-6 w-full">
                            <div
                                class=" bg-white  dark:bg-gray-800 border-gray-300 border dark:border-gray-700 shadow-sm rounded-sm p-2 w-64">
                                hey</div>

                            <div
                                class="gap-2.5 bg-white  dark:bg-gray-800 border-gray-300 border dark:border-gray-700 shadow-sm rounded-sm p-2 w-1/2">
                                hey</div>
                        </div>

                    </div>

                    <div class="py-6">
                        <div class="md:flex ">
                            <div class="md:pr-3 md:min-w-64 space-x-4">
                                <span class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Request
                                    Type:</span>
                            </div>

                        </div>
                        <div class="flex space-x-6 w-full">
                            <div
                                class=" bg-white  dark:bg-gray-800 border-gray-300 border dark:border-gray-700 shadow-sm rounded-sm p-2 w-full">
                                hey</div>


                        </div>

                    </div>

                    <div class="py-6">
                        <div class="md:flex ">
                            <div class="md:pr-3 md:min-w-64 space-x-4">
                                <span class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Description
                                    of Service
                                    Requested:</span>
                            </div>

                        </div>
                        <div class="flex space-x-6 w-full">
                            <div
                                class=" bg-white  dark:bg-gray-800 border-gray-300 border dark:border-gray-700 shadow-sm rounded-sm p-2 w-full h-40">
                            </div>


                        </div>

                    </div>


                </el-dialog>
            </div>
            <Pagination class="mt-4" />
        </div>


    </UserLayout>
</template>