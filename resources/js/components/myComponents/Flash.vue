<script setup lang="ts">
import { computed, ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import type { SharedData, Flash } from '@/types';
import { X } from 'lucide-vue-next';

defineProps<{
    flash: Flash
}>()

const page = usePage<SharedData>();
const message = computed(() => page.props.flash as Flash);
const showFlash = ref(false);

const hideFlash = () => {
    showFlash.value = false
}

const TimeHideFlash = () => {
    setTimeout(() => {
        hideFlash()
    }, 20000);
}

watch(() => [message.value.error, message.value.success], ([newError, newSuccess]) => {
    if (newError || newSuccess) {
        showFlash.value = true;
        TimeHideFlash();
    }
}, { immediate: true });

</script>

<template>
    <div>
        <template v-if="message.success && showFlash">
            <div class="mx-4 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                <strong class="font-bold">Succés!</strong>
                <p >{{ message.success }}</p>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="hideFlash">
                    <X class="cursor-pointer" />
                </span>
            </div>
        </template>
        <template v-else-if="message.error && showFlash">
            <div class="mx-4 mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
                <strong class="font-bold">Erreur!</strong>
                <p >{{ message.error }}</p>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="hideFlash">
                    <X class="cursor-pointer" />
                </span>
            </div>
        </template>
    </div>
</template>