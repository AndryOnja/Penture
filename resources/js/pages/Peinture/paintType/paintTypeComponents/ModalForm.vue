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
import { Label } from '@/components/ui/label'
import { Button } from '@/components/ui/button'
import { PlusCircle, FilePenLine } from 'lucide-vue-next'
import { PaintType } from '@/types/peinture'
import { ref } from 'vue'


const props = defineProps<{
    data?: PaintType
}>()

const modal = ref(false)

const resetForm = () => {
  form.name = props.data?.name ?? ''
  form.description = props.data?.description ?? ''
}

const showModal = () => {
    resetForm()
    modal.value = true
}

const closeModal = () => {
  modal.value = false
  form.reset()
}

const form = useForm({
    name: props.data?.name ?? '',
    description: props.data?.description ?? ''
})

const createPaintType = () => {
    form.post(route('paintTypes.store'), {
        onSuccess: () => closeModal(),
        onError: (errors: any) => console.log(errors)
    })
}

const updatePaintType = () => {
    form.put(route('paintTypes.update', props.data?.id), {
        onSuccess: () => closeModal(),
        onError: (errors: any) => console.log(errors)
    })
}

const submitForm = () => {
    if (props.data) {
        updatePaintType()
    } else {
        createPaintType()
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
                    <PlusCircle /> Nouvelle type de peinture
                </Button>
            </template>
        </DialogTrigger>
        <DialogContent v-if="modal" class="">
            <DialogHeader>
                <DialogTitle>{{ data ? "Modif peinture type" : "Nouvelle type de peinture" }}</DialogTitle>
                <DialogDescription>
                    Le champs <span class="text-green-500">Nom</span> est obligatoire
                </DialogDescription>
            </DialogHeader>
            <form @submit.prevent="submitForm">
                <div class="grid gap-4 py-4">
                    <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="name" class="text-right">
                            Nom
                        </Label>
                        <Input id="name" v-model="form.name" class="col-span-3" />
                    </div>
                    <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="description" class="text-right">
                            Description
                        </Label>
                        <Textarea id="description" v-model="form.description" class="col-span-3" />
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