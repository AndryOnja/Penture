<script setup lang="ts">
import { Category, Ingredient } from '@/types/peinture';
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button'
import { Separator } from '@/components/ui/separator';
import { Trash2 } from 'lucide-vue-next';
import { router } from '@inertiajs/vue3';
import ModalForm from './ModalForm.vue';

defineProps<{
    ingredients: Ingredient[]
    categories: Category[]
}>()

const deleteIngredient = (id: number) => {
    if(confirm('Êtes-vous sûr de supprimer?')){
        router.delete(route('ingredients.destroy', id));
    }
};
</script>

<template>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
        <div v-for="ingredient in ingredients" :key="ingredient.id">
            <Card class="h-full shadow-sm hover:shadow-md dark:hover:shadow-gray-800 transition-shadow">
                <CardHeader>
                    <CardTitle>{{ ingredient.name }}</CardTitle>
                    <CardDescription><Badge>{{ ingredient.category.name }}</Badge></CardDescription>
                </CardHeader>
                <CardContent>
                    {{ ingredient.description }}

                    <Separator label="infos" class="my-4"/>

                    <div class="mb-1">Densité:  <b>{{ ingredient.density == 0 ? 'Inconnu' : ingredient.density }}</b></div>
                    <div>Unité utiliser <b>{{ ingredient.unit }}</b></div>
                </CardContent>
                <CardFooter class="flex justify-between">
                        <ModalForm :data="ingredient" :categories="categories"/>
                        <Button variant="destructive" @click="deleteIngredient(ingredient.id)"><Trash2/></Button>
                </CardFooter>
            </Card>
        </div>
    </div>
</template>