<script setup>
import UserDropdown from '@/Components/DropdownNavbar.vue';
import Sidebar from "@/Components/Sidebar.vue";
import FooterAdmin from "@/Components/FooterAdmin.vue";
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <sidebar />
        <div class="relative md:ml-64 bg-blueGray-100">
            <!-- Navbar -->
            <nav
                class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4">
                <div class="w-full mx-autp items-center flex justify-between md:flex-nowrap flex-wrap md:px-10 px-4">
                    <!-- Brand -->
                    <a class="text-white text-sm uppercase hidden lg:inline-block font-semibold" href="javascript:void(0)">
                        <slot name="header" />
                    </a>

                    <!-- User -->
                    <ul class="flex-col md:flex-row list-none items-center hidden md:flex">
                        <user-dropdown />
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="relative bg-emerald-600 md:pt-32 pb-32 pt-12">
                <slot />
            </div>
            <div class="px-4 md:px-10 mx-auto w-full -m-24">

                <footer-admin />
            </div>
        </div>
    </div>
</template>
