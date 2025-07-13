<script setup>
import MDLayout from "@/Layouts/MDLayout.vue";
import { usePage, router, Link } from "@inertiajs/vue3";
import Pagination from "./Pagination.vue";
import { ref } from "vue";
const dialogVisible = ref(false);
const dialogVisible1 = ref(false);
const { props } = usePage();

let submit = () => {
    router.post("/status");
};

const can = usePage(() => props.auth.can);
//   const createUser= (values, { resetForm}) => {
//     axios.post('/request/my-request', values)
//     .then((response)) => {
//         users.value.unshift
//     }
//   }

//   const editUser = () => {
//     $('#createUserModal').modal('show');
//   };
// let propss = defineProps({
//     can: Object,
// })
const viewing = () => {
    router.get("/request/viewing");
};
</script>
<template>
    <MDLayout>
        
        <section class="bg-white py-2 antialiased dark:bg-gray-900 md:py-4 w-full">
           {{ props.ict_service_request_status_id}} <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="mx-auto max-w-5xl">
                    <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
                            Request List {{ props.ict_technicians.ict_technicianss }}
                        </h2>

                        <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                            <div>
                                <label for="order-type"
                                    class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                    order type</label>
                                <select id="order-type"
                                    class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                    <option selected>All requests</option>
                                    <option value="pre-order">Pending</option>
                                    <option value="confirmed">Aprroved</option>
                                    <option value="cancelled">
                                        Disapproved
                                    </option>
                                </select>
                            </div>

                            <span class="inline-block text-gray-500 dark:text-gray-400">
                                from
                            </span>

                            <div>
                                <label for="duration"
                                    class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select
                                    duration</label>
                                <select id="duration"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                                    <option selected>this week</option>
                                    <option value="this month">
                                        this month
                                    </option>
                                    <option value="last 3 months">
                                        the last 3 months
                                    </option>
                                    <option value="lats 6 months">
                                        the last 6 months
                                    </option>
                                    <option value="this year">this year</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flow-root sm:mt-8" v-for="assets_1 in props.assets_1.data" :key="assets_1.id">
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            <div class="flex flex-wrap items-center gap-8 py-2">
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">
                                        Request ID:
                                    </dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        <a href="#" class="hover:underline">{{
                                            assets_1.id
                                        }}</a>
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">
                                        Name:
                                    </dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        {{ assets_1.requested_by }}
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-none">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">
                                        Date Requested:
                                    </dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        {{ assets_1.date_requested }}
                                    </dd>
                                </dl>

                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">
                                        Status:
                                    </dt>
                                    <dd
                                        class="me-2 mt-1.5 inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                        {{assets_1.status_name}}
                                    </dd>
                                </dl>
                                <div
                                    class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                    <!-- <button
                                        type="button"
                                        class="w-full rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900 lg:w-auto"
                                    >
                                        Appoved
                                    </button> -->

                                    <el-button plain @click="dialogVisible = true">
                                        Approved
                                    </el-button>

                                    <button type="button"
                                        class="w-full rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900 lg:w-auto">
                                        Disapproved
                                    </button>
                                    <!-- <a
                                        href="#"
                                        class="w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto"
                                        >View details</a
                                    > -->
                                    <el-button plain @click="dialogVisible1 = true">
                                        View Details
                                    </el-button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <Pagination class="mt-4" />
                </div>
            </div>
        </section>

        <el-dialog v-model="dialogVisible" :modal="false" width="400" :show-close="false">
            <template #header="{ close, titleId, titleClass }">
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Select Technician
                    </h3>
                    <button @click="close" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </template>
            <div class="relative w-full max-w-sm max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->

                    <!-- Modal body -->
                    <form class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2 sm:col-span-1 w-[calc(100%+8rem)]">
                                <label for="category"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Technician</label>
                                <select id="category"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    
                                    <option v-for="ict_technician in props.technicians" :key="ict_technician.id" :value="ict_technician.id"
                                        >
                                        {{ ict_technician.technicianss }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- <button
                            type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            <svg
                                class="me-1 -ms-1 w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                            Add new product
                        </button> -->
                    </form>
                </div>
            </div>
            <template #footer>
                <div class="dialog-footer">
                    <el-button @click="dialogVisible = false">Cancel</el-button>
                    <el-button type="primary" @click="dialogVisible = false">
                        Confirm
                    </el-button>
                </div>
            </template>
        </el-dialog>

        <el-dialog v-model="dialogVisible1" :modal="false" width="500" :show-close="false">
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
            </template>
            <!-- component -->


            <!-- component -->
            <!-- component -->
            <!-- This is an example component -->

           
<div class="w-full max-w-lg bg-white dark:bg-gray-800 border-gray-200 border dark:border-gray-700 shadow-sm rounded-lg p-5">
    <label for="account-id" class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Requested_by:</label>
    <div class="relative mb-4">
        <input id="account-id" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="756593826" disabled readonly>
    </div>
    <label for="api-key" class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Department/Unit:</label>
    <div class="relative mb-4">
        <input id="api-key" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="f4h6sd3t-jsy63ind-hsgdt7rs-jdhf76st" disabled readonly>
    </div>
    <label for="role-arn" class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Date:</label>
    <div class="relative mb-6">
        <input id="role-arn" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="123456789012:user/Flowbite" disabled readonly>
    </div>
    <label for="role-arn" class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Date_needed:</label>
    <div class="relative mb-6">
        <input id="role-arn" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="123456789012:user/Flowbite" disabled readonly>
    </div>
    <label for="role-arn" class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Request Description:</label>
    <div class="relative mb-6">
        <input id="role-arn" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="123456789012:user/Flowbite" disabled readonly>
    </div>
    <label for="role-arn" class="text-sm font-medium text-gray-900 dark:text-white mb-2 block">Request Type:</label>
    <div class="relative mb-6">
        <input id="role-arn" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-500 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" value="123456789012:user/Flowbite" disabled readonly>
    </div>
</div>



        </el-dialog>
    </MDLayout>
</template>