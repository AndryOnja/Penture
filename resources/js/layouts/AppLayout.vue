<script setup lang="ts">
import { computed } from 'vue';
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItemType, SharedData, Flash as F } from '@/types';
import { usePage } from '@inertiajs/vue3';
import Flash from '@/components/myComponents/Flash.vue';

const page = usePage<SharedData>();

const flash = computed(() => page.props.flash as F);

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Flash v-if="flash.error || flash.success" :flash="flash"/>
        <slot />
    </AppLayout>
</template>
