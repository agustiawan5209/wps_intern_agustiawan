<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, defineProps } from 'vue';
import Swal from 'sweetalert2';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps({
    kriteria: {
        type: Object,
        default: () => ({})
    },
    kode: String,
})

const Addform = useForm({
    kode: props.kode,
    nama: null,
    subkriteria: [],
    bobotsubkriteria: [],
});
function submit() {
    Addform.post(route('Kriteria.store'), {
        onSuccess: () => {
            ModalShow.value = false;
            Addform.reset();
        },
        onError: (error) => {
            Swal.fire(error);
        }
    })
}

const CountKriteria = ref(0);
function plusSubKriteria() {
    CountKriteria.value++
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Kriteria" />
        <template #header>
            <h2 class="font-semibold leading-tight">Kriteria</h2>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border lg:px-10 lg:py-4">
                    <!-- Modal content -->
                    <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
                        <!-- Modal header -->
                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 ">
                            <h3 class="text-lg font-semibold text-gray-900 ">
                                Tambah Kriteria
                            </h3>
                            <button type="button" @click="ModalShow = false"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                data-modal-toggle="defaultModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="#" @submit.prevent="submit">
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div>
                                    <label for="Kode" class="block mb-2 text-sm font-medium text-gray-900 ">Kode</label>
                                    <input type="text" name="Kode" id="Kode" v-model="Addform.kode"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 "
                                        placeholder="Type Kode" required="">
                                    <InputError :message="Addform.errors.kode" />
                                </div>
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">name</label>
                                    <input type="text" name="name" id="name" v-model="Addform.nama"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 "
                                        placeholder="name" required="">
                                    <InputError :message="Addform.errors.nama" />
                                </div>
                            </div>
                            <PrimaryButton
                                class="text-white inline-flex items-center bg-primary hover:bg-info focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Simpan
                            </PrimaryButton>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
