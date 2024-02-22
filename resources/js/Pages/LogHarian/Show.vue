
<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps(['log'])

console.log(props.log)
</script>
<template>
    <div>
        <div class="container p-2 mx-auto sm:p-4 ">
            <h2 class="mb-4 text-2xl font-semibold leadi">Detail Log Harian Pegawai</h2>
            <div class="overflow-x-auto">
                <table class="w-full p-6 text-xs text-left whitespace-nowrap">
                    <tr>
                        <th class="px-2 text-base">ID Pegawai</th>
                        <td class="px-3 py-2 text-base">{{ log.id_pegawai }}</td>

                    </tr>
                    <tr>
                        <th class="px-2 text-base">Tanggal</th>
                        <td class="px-3 py-2 text-base">{{ log.tanggal }}</td>

                    </tr>
                    <tr>
                        <th class="px-2 text-base">Deskripsi</th>
                        <td class="px-3 py-2 text-base">{{ log.deskripsi }}</td>
                    </tr>
                    <tr>
                        <th class="px-2 text-base">File</th>
                        <td class="px-3 py-2 text-base">
                            <a v-if="log.file" :href="log.file" target="_blank">{{ log.file }}</a>
                            <span v-else>File Tidak Ada</span>
                        </td>
                    </tr>
                    <tr>
                        <th class="px-2 text-base">Status</th>
                        <td class="px-3 py-2 text-base">{{ log.status }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

