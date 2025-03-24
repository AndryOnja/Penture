<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { PaintType } from '@/types/peinture/index';
import ListePaintType from './paintTypeComponents/ListePaintType.vue';
import ModalForm from './paintTypeComponents/ModalForm.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Peinture type',
        href: '/paintTypes',
    },
];

defineProps<{
    paintTypes: PaintType[]
}>()

</script>

<template>
    <Head title="Peinture type" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="px-4 pt-4 flex justify-end">
                    <ModalForm/>
                </div>

                <ListePaintType :paintTypes="paintTypes"/>
            </div>
        </div>
    </AppLayout>
</template>