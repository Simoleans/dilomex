<template lang="">
    <AuthenticatedLayout title="Cobro por Kilometro">
        <template #header>
            <div class="flex  gap-4 md:flex-row md:items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight">Cobro por Kilometro</h2>
                <button @click="openModal(false,'create')" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="pi pi-plus mr-2"></i>
                    <span>Crear Cobro por Kilometro</span>
                </button>
            </div>
        </template>

        <div class="grid items-center gap-6 mt-4">
            <Table :data="data"  @openModal="openModal"/>
        </div>

        <Modal :show="open" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ module == 'create' ? 'Crear Cobro por Kilometro' : (module == 'edit' ? 'Editar Cobro por Kilometro' : 'Eliminar Cobro por Kilometro') }}
                </h2>
                <hr class="m-5">
                <form @submit.prevent="handleForm">
                    <div class="mb-3">
                        <InputLabel value="Localidad:" class="mb-2"/>
                        <Dropdown v-model="form.location_id" filter :disabled="module == 'delete'" :options="locations" optionValue="id" optionLabel="name" placeholder="Selecciona una localidad" class="w-full md:w-14rem border-1 border-sky-500" />
                        <InputError class="mt-2" :message="form.errors.location_id" />
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Costo:" class="mb-2"/>
                        <input type="number" step="0.01" v-model="form.cost" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.cost" />
                    </div>
                    <div class="flex items-center justify-end gap-4">
                        <button
                            class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="button"
                            @click="closeModal">
                                Cerrar
                        </button>
                        <button :class="{ 'opacity-25': form.processing, 'bg-red-600' : module == 'delete' }"
                            :disabled="form.processing"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                                {{ module == 'create' ? 'Crear' : (module == 'edit' ? 'Editar' : 'Eliminar') }}
                        </button>
                    </div>
                </form>
            </div>
    </Modal>
    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Button from '@/Components/Button.vue'
import Table from './Components/Table.vue'
import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Input from '@/Components/Input.vue'
import { useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import toast from "@/Stores/toast";
import { usePage } from '@inertiajs/vue3'
import Dropdown from 'primevue/dropdown';


const props = defineProps({
    data: Array,
    locations : Array
})


const open = ref(false)

const form = useForm({
    cost: '',
    location_id: '',
})

const module = ref('create')
const id = ref('')


const openModal = (data,type) => {
    open.value = true
    id.value = data.id

    if(type == 'edit'){
        module.value = 'edit'
        form.location_id = data.location_id
        form.cost = data.cost


    }else if(type == 'create'){
        module.value = 'create'
        form.name = ''

    }else{
        module.value = 'delete'
        form.location_id = data.location_id
        form.cost = data.cost

    }
}

const closeModal = () => {
    open.value = false
    form.reset()
}

const handleForm = () => {
    if(module.value == 'create'){
        form.post(route('kilometer-cost.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.add({
                message: usePage().props.toast.message,
                type: usePage().props.toast.type
            });
            closeModal()
        }
    })
    }else if(module.value == 'edit'){
        form.put(route('kilometer-cost.update', id.value), {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    message: usePage().props.toast.message,
                    type: usePage().props.toast.type
                });
                closeModal()
            },
            onError: () => {
                toast.add({
                    message: 'Error',
                    type: 'error'
                });
                closeModal()
            }
        })
    }else{
        form.delete(route('kilometer-cost.destroy', id.value), {
            preserveScroll: true,
            onSuccess: () => {
                toast.add({
                    message: usePage().props.toast.message,
                    type: usePage().props.toast.type
                });
                closeModal()
            },
            onError: () => {
                toast.add({
                    message: 'Error',
                    type: 'error'
                });
                closeModal()
            }
        })
    }
}

</script>
