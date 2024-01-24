<template lang="">
    <AuthenticatedLayout title="Clientes">
        <template #header>
            <div class="flex  gap-4 md:flex-row md:items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight">Clientes</h2>
                <button @click="openModal(false,'create')" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="pi pi-plus mr-2"></i>
                    <span>Crear Cliente</span>
                </button>
            </div>
        </template>

        <div class="mt-4">
            <Table :data="data"  @openModal="openModal"/>
        </div>

        <Modal :show="open" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ module == 'create' ? 'Crear Cliente' : (module == 'edit' ? 'Editar Cliente' : 'Eliminar Cliente') }}
                </h2>
                <hr class="m-5">
                <form @submit.prevent="handleForm">
                    <div class="flex gap-4 flex-col md:lg:flex-row items-center">
                        <div class="mb-3 w-full">
                            <InputLabel value="Codigo:" class="mb-2"/>
                            <input type="text" id="code" v-model="form.code" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <InputError class="mt-2" :message="form.errors.code" />
                        </div>
                        <div class="mb-3 w-full">
                            <InputLabel value="Nombre del Cliente:" class="mb-2"/>
                            <input type="text" id="name" v-model="form.name" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Empresa:" class="mb-2"/>
                        <Dropdown v-model="form.company_id" filter :options="companies" :disabled="module == 'delete'" optionValue="id" optionLabel="name" placeholder="Selecciona una empresa" class="w-full md:w-14rem border-1 border-sky-500" />
                        <InputError class="mt-2" :message="form.errors.company_id" />
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Tipo de cliente:" class="mb-2"/>
                        <Dropdown v-model="form.customer_type_id" filter :options="customerTypes" :disabled="module == 'delete'" optionValue="id" optionLabel="name" placeholder="Selecciona una empresa" class="w-full md:w-14rem border-1 border-sky-500" />
                        <InputError class="mt-2" :message="form.errors.customer_type_id" />
                    </div>
                    <div class="flex gap-4 flex-col md:lg:flex-row items-center">
                        <div class="mb-3 w-full">
                            <InputLabel value="Colonia:" class="mb-2"/>
                            <input type="text" id="colony" v-model="form.colony" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <InputError class="mt-2" :message="form.errors.colony" />
                        </div>
                        <div class="mb-3 w-full">
                            <InputLabel value="Calle:" class="mb-2"/>
                            <input type="text" id="street" v-model="form.street" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <InputError class="mt-2" :message="form.errors.street" />
                        </div>
                    </div>
                    <div class="flex gap-4 flex-col md:lg:flex-row items-center">
                        <div class="mb-3 w-full">
                            <InputLabel value="Estado:" class="mb-2"/>
                            <input type="text" id="state" v-model="form.state" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <InputError class="mt-2" :message="form.errors.state" />
                        </div>
                        <div class="mb-3 w-full">
                            <InputLabel value="Localidad:" class="mb-2"/>
                            <Dropdown v-model="form.location_id" filter :disabled="module == 'delete'" :options="locations" optionValue="id" optionLabel="name" placeholder="Selecciona una localidad" class="w-full md:w-14rem border-1 border-sky-500" />
                            <InputError class="mt-2" :message="form.errors.location_id" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Prioridad:" class="mb-2"/>
                        <input type="text" id="priority" v-model="form.priority" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <InputError class="mt-2" :message="form.errors.priority" />
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Codigo Postal:" class="mb-2"/>
                        <input type="text" id="postal_code" v-model="form.postal_code" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <InputError class="mt-2" :message="form.errors.postal_code" />
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
    companies : Array,
    locations : Array,
    customerTypes : Array,
})


const open = ref(false)

const form = useForm({
    name: '',
    code: '',
    customer_type_id: '',
    company_id: '',
    location_id: '',
    street: '',
    colony: '',
    state: '',
    priority : '',
    postal_code: '',
})

const module = ref('create')
const id = ref('')


const openModal = (data,type) => {
    open.value = true

    if(type == 'edit' || type == 'delete'){
        module.value = type
        id.value = data.id
        form.name = data.name
        form.code = data.code
        form.street = data.street
        form.customer_type_id = data.customer_type_id
        form.company_id = data.company_id
        form.location_id = data.location_id
        form.colony = data.colony
        form.state = data.state
        form.priority = data.priority
        form.postal_code = data.postal_code
    }else if(type == 'create'){
        module.value = 'create'
        form.name = ''
        form.code = ''
        form.street = ''
        form.colony = ''
        form.state = ''
        form.priority = ''
        form.postal_code = ''
    }
}

const closeModal = () => {
    open.value = false
    form.reset()
}

const handleForm = () => {
    if(module.value == 'create'){
        form.post(route('customers.store'), {
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
        form.put(route('customers.update', id.value), {
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
        form.delete(route('customers.destroy', id.value), {
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
