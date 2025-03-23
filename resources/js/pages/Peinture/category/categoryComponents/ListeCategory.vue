<script setup lang="ts">
import { Category } from '@/types/peinture/index';
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Trash2 } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';
import ModalForm from './ModalForm.vue';

defineProps<{
    categories: Category[]
}>()

const deleteCategory = (id: number) => {
    if(confirm('Êtes-vous sûr de supprimer?')){
        router.delete(route('categories.destroy', id));
    }
};

</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
        <div v-for="category in categories" :key="category.id">
            <Card class="h-full shadow-sm hover:shadow-md dark:hover:shadow-gray-800 transition-shadow">
                <CardHeader>
                    <CardTitle>{{ category.name }}</CardTitle>
                    <CardDescription></CardDescription>
                </CardHeader>
                <CardContent>
                    {{ category.description }}
                </CardContent>
                <CardFooter class="flex justify-between">
                        <ModalForm :data="category"/>
                        <Button variant="destructive" @click="deleteCategory(category.id)"><Trash2/></Button>
                </CardFooter>
            </Card>
        </div>
    </div>
</template>
