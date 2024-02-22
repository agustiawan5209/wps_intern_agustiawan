<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

const page = usePage().props.flash;
var toastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: 'General Title',
    animation: false,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
if (page.success !== null) {
    toastMixin.fire({
        title: page.success,
    })
}
if (page.error !== null) {
    toastMixin.fire({
        title: 'Terjadi Kesalahan',
        text: page.error,
        icon: 'error'
    })
}
</script>

<template>
    <div>

    </div>
</template>
