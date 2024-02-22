<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'text-emerald-500 hover:text-emerald-600'
        : 'text-black hover:text-blue-500',
);
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
