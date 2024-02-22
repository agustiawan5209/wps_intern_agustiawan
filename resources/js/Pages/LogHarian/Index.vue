<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import Message from '@/Components/Message.vue';
import ShowVue from './Show.vue';
import { ref, defineProps } from 'vue';
const props = defineProps({
    LogHarian: {
        type: Object,
        default: () => ({})
    },
})
console.log(props.LogHarian.length)


const search = ref(null);

const ModalTambah = ref(false);

const Form = useForm({
    deskripsi: '',
    tanggal: '',
    file: '',
    status: 1,
})

const submit = () => {
    Form.post(route('LogHarian.store'), {
        onSuccess: () => {
            ModalTambah.value = false;
            Form.reset()
        },
    });
};

function castStatus(status) {
    switch (status) {
        case '1':
            return 'Pending';
        case '2':
            return 'Ditolak';
        case '3':
            return 'Disetujui';
        default:
            return 'Unknown';
    }
}

// Modal
const modalDelete = ref(false);
function showModaldelete(param) {
    modalDelete.value = true;
    FormDelete.slug = param;
}
function closeModal() {
    modalDelete.value = false;
    FormDelete.slug = null;
}

// Delete
const FormDelete = useForm({
    slug: null,
});
function deleteLog() {
    FormDelete.delete(route('LogHarian.destroy', {slug: FormDelete.slug}), {
        onSuccess: () => {
            modalDelete.value = false;
            FormDelete.reset()
        }
    })
}

const ModalShow = ref(false);
const data_Show= ref({})
function ShowLogHarian(item){
    ModalShow.value = true;
    data_Show.value = item;
    console.log(item)
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="LogHarian" />
        <template #header>
            <h2 class="font-semibold leading-tight">LogHarian</h2>
            <Message/>
        </template>

        <!-- Modal tambah -->
        <Modal :show="ModalTambah">
            <section class="p-6 ">
                <form @submit.prevent="submit" class="container  mx-auto space-y-12">
                    <fieldset class="grid grid-cols-4 gap-6 rounded-md shadow-sm">
                        <div class="space-y-2 col-span-full lg:col-span-1">
                            <p class="font-medium">Form Input Log Harian</p>
                            <p class="text-xs">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci fuga autem
                                eum!</p>
                        </div>
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">

                            <div class="col-span-full">
                                <InputLabel for="Deskripsi" value="Deskripsi" />
                                <TextInput id="Deskripsi" v-model="Form.deskripsi" class="w-full" type="text"
                                    placeholder="masukkan deskripsi pekerjaan" />
                                <InputError class="mt-2" :message="Form.errors.deskripsi" />

                            </div>
                            <div class="col-span-full sm:col-span-2">
                                <InputLabel for="Tanggal" value="Tanggal" />
                                <TextInput id="Tanggal" type="date" class=" w-full" v-model="Form.tanggal" required
                                    autocomplete="current-Tanggal" autofocus />
                                <InputError class="mt-2" :message="Form.errors.tanggal" />

                            </div>
                            <div class="col-span-full">
                                <InputLabel for="file" value="Bukti Pekerjaan" />

                                <div class="flex items-center space-x-2">
                                    <input type="file" id="file" @input="Form.tanggal = $event.target.files[0]"
                                        class="px-4 py-2 border rounded-md dark:border-gray-100" />
                                </div>
                                <span class="text-red-500 text-xs">Dapat Dikosongkan</span>
                                <InputError class="mt-2" :message="Form.errors.file" />

                            </div>
                            <div class="col-span-full">
                                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Select an
                                    option</label>
                                <select id="countries" v-model="Form.status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected>--Status Pekerjaan--</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Ditolak</option>
                                    <option value="3">Disetujui</option>
                                </select>
                            </div>
                            <PrimaryButton type="submit" class="col-span-full text-center text-lg">Simpan</PrimaryButton>
                        </div>
                    </fieldset>
                </form>
            </section>
        </Modal>


        <!-- End Modal Tambah -->
        <!-- Modal Delete -->
        <Modal :show="modalDelete" :maxWidth="'md'">
            <div class="max-w-full h-full flex justify-center items-center ">
                <div class="block bg-white rounded-lg py-5">
                    <h3 class="mb-4">Apakah Anda Yakin?</h3>
                    <div class="flex justify-around">
                        <PrimaryButton type="button" @click="deleteLog()"
                            class="bg-blue-500 hover:bg-blue-600 active:bg-blue-800">Ya
                        </PrimaryButton>
                        <PrimaryButton type="button" @click="closeModal()"
                            class="bg-error hover:bg-red-600 active:bg-red-800">Batal</PrimaryButton>
                    </div>
                </div>
            </div>
        </Modal>
        <!-- End Modal Delete -->
        <!-- Modal Show -->
        <Modal :show="ModalShow" :maxWidth="'md'">
            <div class="container p-2 mx-auto sm:p-4 ">
                <PrimaryButton type="button" class="bg-red-500 hover:bg-red-600 hover:text-white" @click="ModalShow=false">Tutup</PrimaryButton>

                <h2 class="mb-4 text-2xl font-semibold leadi">Detail Log Harian Pegawai</h2>
                <div class="overflow-x-auto">
                    <table class="w-full p-6 text-xs text-left whitespace-nowrap">
                        <tr>
                            <th class="px-2 text-base">ID Pegawai</th>
                            <td class="px-3 py-2 text-base">{{ data_Show.id_pegawai }}</td>

                        </tr>
                        <tr>
                            <th class="px-2 text-base">Tanggal</th>
                            <td class="px-3 py-2 text-base">{{ data_Show.tanggal }}</td>

                        </tr>
                        <tr>
                            <th class="px-2 text-base">Deskripsi</th>
                            <td class="px-3 py-2 text-base">{{ data_Show.deskripsi }}</td>
                        </tr>
                        <tr>
                            <th class="px-2 text-base">File</th>
                            <td class="px-3 py-2 text-base">
                                <a v-if="data_Show.file" :href="data_Show.file" target="_blank">{{ data_Show.file }}</a>
                                <span v-else>File Tidak Ada</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="px-2 text-base">Status</th>
                            <td class="px-3 py-2 text-base">{{ data_Show.status }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </Modal>
        <!-- End Modal Show -->
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border lg:px-10 lg:py-4">
                    <div class="border border-gray-300 rounded-lg ">
                        <div class="relative shadow-md">
                            <div
                                class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                                <div class="w-full md:w-1/2">
                                    <form class="flex items-center">
                                        <label for="simple-search" class="sr-only">Cari</label>
                                        <div class="relative w-full">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor"
                                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input type="search" id="simple-search" v-model="search"
                                                class="block w-full p-2 pl-10 text-sm border  rounded-lg  bg-gray-100 border-gray-600 placeholder-gray-400 text-gray-600 focus:ring-primary-500 focus:border-primary-500"
                                                placeholder="Search">
                                        </div>
                                    </form>
                                </div>
                                <div class="w-full md:w-1/2 lg:text-right">
                                    <PrimaryButton @click="ModalTambah = true" type="button">Tambah</PrimaryButton>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto ">
                            <table class="w-full text-sm text-left text-gray-400">
                                <thead class="text-xs  uppercase border-b text-gray-900">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            No.
                                        </th>
                                        <th scope="col" class="px-4 py-3">Nama Pegawai</th>
                                        <th scope="col" class="px-4 py-3">Tanggal</th>
                                        <th scope="col" class="px-4 py-3">Deskripsi</th>
                                        <th scope="col" class="px-4 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in LogHarian.data" :key="item.id" :index="index"
                                        class="border border-gray-600 hover:bg-gray-200">
                                        <td class="w-4 px-4 py-3 text-center text-gray-700">
                                            {{ (LogHarian.current_page - 1) * LogHarian.per_page + index + 1 }}

                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            <span
                                                class=" text-base font-medium px-2 py-0.5 rounded whitespace-nowrap bg-primary-900 text-gray-800">
                                                {{ item.user.name }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-center font-medium whitespace-nowrap text-gray-600">
                                            {{ item.tanggal }}
                                        </td>
                                        <td class="px-4 py-2 text-center font-medium whitespace-nowrap text-gray-600">
                                            {{ item.deskripsi }}
                                        </td>
                                        <td class="px-4 py-2 text-center font-medium whitespace-nowrap text-gray-600">
                                            {{ castStatus(item.status) }}
                                        </td>
                                        <td>
                                            <div class="flex items-center justify-center gap-4">
                                                <PrimaryButton type="button"
                                                    class="bg-transparent text-red-500 hover:text-white hover:bg-red-600 active:bg-red-400"
                                                    @click="showModaldelete(item.id)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </PrimaryButton>
                                                <PrimaryButton @click="ShowLogHarian(item)"
                                                    as="button" class=" px-2 py-2 rounded-lg bg-transparent text-blue-500 hover:text-white hover:bg-blue-600 active:bg-blue-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>

                                                </PrimaryButton>
                                                <Link :href="route('LogHarian.edit', { slug: item.id })" method="get"
                                                    as="button" class="px-2 py-2 rounded-lg bg-transparent text-green-500 hover:text-white hover:bg-green-600 active:bg-green-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                      </svg>


                                                </Link>
                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                                <!-- <tbody v-else>
                                    <tr>
                                        <td colspan="10" class="text-center font-semibold py-4">
                                            Maaf Data Kosong
                                        </td>
                                    </tr>
                                </tbody> -->
                            </table>
                        </div>
                        <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                            aria-label="Table navigation">
                            <Pagination :links="LogHarian.links" />
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
