// useCrudOperations.ts
import { useForm } from '@inertiajs/vue3'
import { Ref, ref } from 'vue'

interface CrudOptions {
  afterSubmit?: () => void
  resetForm?: boolean
  closeModal?: boolean
  modalRef?: Ref<boolean>
}

export function useCrudOperations<T extends Record<string, any>>(
  initialData: T,
  options: CrudOptions = {}
) {
  const form = useForm<T>(initialData)

  const defaultOptions: Required<CrudOptions> = {
    afterSubmit: () => {},
    resetForm: true,
    closeModal: true,
    modalRef: ref(true),
    ...options
  }

  const create = (url: string) => {
    form.post(url, {
      onSuccess: () => {
        if (defaultOptions.resetForm) {
          form.reset()
        }

        if (defaultOptions.closeModal && defaultOptions.modalRef) {
          defaultOptions.modalRef.value = false
        }

        defaultOptions.afterSubmit()
      }
    })
  }

  const update = (url: string, id: number | string) => {
    form.put(route(url, id), {
      onSuccess: () => {
        if (defaultOptions.resetForm) {
          form.reset()
        }

        if (defaultOptions.closeModal && defaultOptions.modalRef) {
          defaultOptions.modalRef.value = false
        }

        defaultOptions.afterSubmit()
      }
    })
  }

  const destroy = (url: string, id: number | string) => {
    form.delete(route(url, id), {
      onSuccess: () => {
        if (defaultOptions.resetForm) {
          form.reset()
        }

        if (defaultOptions.closeModal && defaultOptions.modalRef) {
          defaultOptions.modalRef.value = false
        }

        defaultOptions.afterSubmit()
      }
    })
  }

  return {
    form,
    create,
    update,
    destroy
  }
}