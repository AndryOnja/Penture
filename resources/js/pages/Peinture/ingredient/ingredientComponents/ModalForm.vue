<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea'
import {
  NumberField,
  NumberFieldContent,
  NumberFieldDecrement,
  NumberFieldIncrement,
  NumberFieldInput,
} from '@/components/ui/number-field'
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { Label } from '@/components/ui/label'
import { Button } from '@/components/ui/button'
import { PlusCircle, FilePenLine } from 'lucide-vue-next'
import { Category, Ingredient } from '@/types/peinture'
import { ref } from 'vue'


const props = defineProps<{
  data?: Ingredient
  categories: Category[]
}>()

const modal = ref(false) // Commencez avec false

const resetForm = () => {
  form.category_id = props.data?.category_id ?? ''
  form.name = props.data?.name ?? ''
  form.description = props.data?.description ?? ''
  form.density = props.data?.density ?? 0
  form.unit = props.data?.unit ?? 'g'
}

const showModal = () => {
  resetForm() // Réinitialiser le formulaire avant l'ouverture
  modal.value = true
}

const form = useForm({
  category_id: '',
  name: '',
  description: '',
  density: 0,
  unit: 'g',
})

const closeModal = () => {
  modal.value = false
  form.reset()
}

const createIngredient = () => {
  form.post(route('ingredients.store'), {
    onSuccess: () => closeModal(),
    onError: (errors: any) => console.log(errors)
  })
}

const updateIngredient = () => {
  form.put(route('ingredients.update', props.data?.id), {
    onSuccess: () => closeModal(),
    onError: (errors: any) => console.log(errors)
  })
}

const submitForm = () => {
    if (props.data) {
        updateIngredient()
    } else {
        createIngredient()
    }
}

</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <template v-if="data">
                <Button variant="default" @click="showModal">
                    <FilePenLine />
                </Button>
            </template>
            <template v-else>
                <Button variant="outline" @click="showModal">
                    <PlusCircle /> Nouvel ingrédient
                </Button>
            </template>
        </DialogTrigger>
        <DialogContent v-if="modal" class="">
            <DialogHeader>
                <DialogTitle>{{ data ? "Modif ingrédient" : "Nouvel ingrédient" }}</DialogTitle>
                <DialogDescription>
                    Les champs avec une <span class="text-red-500">*</span> sont obligatoires
                </DialogDescription>
            </DialogHeader>
            <form @submit.prevent="submitForm">
                <div class="grid gap-4 py-4">
                    <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="name" class="text-right">
                            Catégorie <span class="text-red-500">*</span>
                        </Label>
                        <Select v-model="form.category_id">
                            <SelectTrigger class="w-full">
                                <SelectValue placeholder="Catégorie" />
                            </SelectTrigger>
                            <SelectContent>
                            <SelectGroup>
                                <SelectLabel>Catégorie</SelectLabel>
                                <template v-for="category in categories" :key="category.id">
                                    <SelectItem :value="category.id">
                                        {{ category.name }}
                                    </SelectItem>
                                </template>
                            </SelectGroup>
                            </SelectContent>
                        </Select>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="name" class="text-right">
                            Nom <span class="text-red-500">*</span>
                        </Label>
                        <Input id="name" v-model="form.name" class="col-span-3" />
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="description" class="text-right">
                            Description
                        </Label>
                        <Textarea id="description" v-model="form.description" class="col-span-3" />
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="density" class="text-right">
                            Densité
                        </Label>
                        <NumberField id="density"
                                v-model="form.density"
                                :min="0"
                                :step="0.1"
                                :format-options="{
                                   minimumFractionDigits: 1,
                                   maximumFractionDigits: 1,
                                }"
                            >
                            <NumberFieldContent>
                            <NumberFieldDecrement />
                            <NumberFieldInput />
                            <NumberFieldIncrement />
                            </NumberFieldContent>
                        </NumberField>
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="unit" class="text-right">
                            Unité <span class="text-red-500">*</span>
                        </Label>
                        <Input id="unit" placeholder="g, kg, ml, l" v-model="form.unit" class="col-span-3" />
                    </div>
                </div>
                <DialogFooter>
                    <Button type="submit">
                        {{ data ? "Modifier" : "Ajouter" }}
                    </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>