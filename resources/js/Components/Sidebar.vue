<template>
    <nav
        class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-gray-100 flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
        <div
            class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
            <!-- Toggler -->
            <button
                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                type="button" v-on:click="toggleCollapseShow('bg-gray-100 m-2 py-3 px-6')">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Brand -->
            <Link
                class="md:block text-left md:pb-2 text-blue-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                href="/">
            Selamat Datang
            </Link>
            <!-- User -->
            <ul class="md:hidden items-center flex flex-wrap list-none">
                <li class="inline-block relative">
                    <user-dropdown />
                </li>
            </ul>
            <!-- Collapse -->
            <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
                v-bind:class="collapseShow">
                <!-- Collapse header -->
                <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blue-200">
                    <div class="flex flex-wrap">
                        <div class="w-6/12">
                            <Link
                                class="md:block text-left md:pb-2 text-blue-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                                href="/">
                            Selamat Datang
                            </Link>
                        </div>
                        <div class="w-6/12 flex justify-end">
                            <button type="button"
                                class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                                v-on:click="toggleCollapseShow('hidden')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-6 mb-4 md:hidden">
                    <div class="mb-3 pt-0">
                        <input type="text" placeholder="Search"
                            class="border-0 px-3 py-2 h-12 border border-solid border-blue-500 placeholder-blue-300 text-blue-600 bg-gray-100 rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal" />
                    </div>
                </form>

                <ul class="md:flex-col md:min-w-full flex flex-col list-none space-y-7">
                    <li class="items-center border-b-2 border-gray-400">
                        <NavLink class="my-3">
                            Dashboard
                        </NavLink>
                    </li>

                    <li class="items-center border-b-2 border-gray-400">
                        <NavLink class="my-3">

                            Pegawai
                        </NavLink>
                    </li>

                    <li class="items-center border-b-2 border-gray-400">
                        <NavLink class="my-3">
                            Log Harian
                        </NavLink>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
</template>


<script>
import UserDropdown from "@/Components/DropdownNavbar.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from '@inertiajs/vue3';

export default {
    data() {
        return {
            collapseShow: "hidden",
            isActive: true
        };
    },
    methods: {
        toggleCollapseShow: function (classes) {
            this.collapseShow = classes;
        },
    },
    components: {
        UserDropdown,
        NavLink,
        Link,
    },
};
</script>
