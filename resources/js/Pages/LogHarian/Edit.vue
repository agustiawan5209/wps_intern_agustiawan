<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, defineProps } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps({
    LogHarian: {
        type: Object,
        default: () => ({})
    },
    kode: String,
})
const Form = useForm({
    deskripsi: '',
    tanggal: '',
    file: '',
    status: 1,
})

function submit() {
    Addform.post(route('LogHarian.update'), {
        onSuccess: () => {
            ModalShow.value = false;
            Addform.reset();
        },
        onError: (error) => {
            Swal.fire(error);
        }
    })
}

</script>

<template>
    <AuthenticatedLayout>

        <Head title="LogHarian" />
        <template #header>
            <h2 class="font-semibold leading-tight">LogHarian Edit</h2>

        </template>

        <div class="py-12 mx-auto px-10">
            <section class="p-6 bg-white">
                <Link :href="route('LogHarian.index')">
                    <PrimaryButton type="button" class="bg-red-500 hover:bg-red-600 hover:text-white" >Kembali</PrimaryButton>
                </Link>

                <form @submit.prevent="submit" class="container  mx-auto space-y-12">
                    <fieldset class="grid grid-cols-4 gap-6 rounded-md shadow-sm">
                        <div class="space-y-2 col-span-full lg:col-span-1">
                            <p class="font-medium">Form Input Log Harian</p>
                            <p class="text-xs">
                            Edit Data Log Harian
                            </p>
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
                            <PrimaryButton type="submit" class="col-span-full text-center text-lg">Simpan</PrimaryButton>
                        </div>
                    </fieldset>
                </form>
            </section>
        </div>

    </AuthenticatedLayout>
</template>
