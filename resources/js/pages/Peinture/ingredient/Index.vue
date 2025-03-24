<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Ingredient, Category } from '@/types/peinture/index';
import ListeIngredient from './ingredientComponents/ListeIngredient.vue';
import ModalForm from './ingredientComponents/ModalForm.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Categorie(peinture)',
        href: '/categories',
    },
];

defineProps<{
    ingredients: Ingredient[],
    categories: Category[]
}>()

</script>

<template>
    <Head title="Categorie(peinture)" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <div class="px-4 pt-4 flex justify-end">
                    <ModalForm :categories="categories"/>
                </div>

                <ListeIngredient :ingredients="ingredients" :categories="categories" />
            </div>
        </div>
    </AppLayout>
</template>