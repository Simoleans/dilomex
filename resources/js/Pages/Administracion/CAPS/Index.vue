<template lang="">
    <AuthenticatedLayout title="CAPs">
        <template #header>
            <div class="flex  gap-4 md:flex-row md:items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight">CAPs</h2>
                <button @click="openModal(false,'create')" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="pi pi-plus mr-2"></i>
                    <span>Crear CAPs</span>
                </button>
            </div>
        </template>

        <div class="grid items-center gap-6 mt-4">
            <Table :data="data"  @openModal="openModal"/>
        </div>

        <Modal :show="open" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ module == 'create' ? 'Crear CAPs' : (module == 'edit' ? 'Editar CAPs' : 'Eliminar CAPs') }}
                </h2>
                <hr class="m-5">
                <form @submit.prevent="handleForm">
                    <div class="flex gap-4 flex-col md:lg:flex-row items-center">
                        <div class="mb-3 w-full">
                            <InputLabel value="Razon Social:" class="mb-2"/>
                            <input type="text" id="business_name" v-model="form.business_name" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <InputError class="mt-2" :message="form.errors.business_name" />
                        </div>
                        <div class="mb-3 w-full">
                            <InputLabel value="Contacto:" class="mb-2"/>
                            <input type="text" id="contact" v-model="form.contact" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <InputError class="mt-2" :message="form.errors.contact" />
                        </div>
                    </div>
                    <div class="flex gap-4 flex-col md:lg:flex-row items-center">
                        <div class="mb-3 w-full">
                            <InputLabel value="Correo Electronico:" class="mb-2"/>
                            <input type="email" id="email" v-model="form.email" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="mb-3 w-full">
                            <InputLabel value="Telefono:" class="mb-2"/>
                            <input type="text" id="phone" v-model="form.phone" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Calle:" class="mb-2"/>
                        <input type="text" id="street" v-model="form.street" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.street" />
                    </div>
                    <div class="flex gap-4 flex-col md:lg:flex-row items-center">
                        <div class="mb-3 w-full">
                            <InputLabel value="Número:" class="mb-2"/>
                            <input type="text" id="number" v-model="form.number" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <InputError class="mt-2" :message="form.errors.number" />
                        </div>
                        <div class="mb-3 w-full">
                            <InputLabel value="Interior:" class="mb-2"/>
                            <input type="text" id="interior" v-model="form.interior" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            <InputError class="mt-2" :message="form.errors.interior" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Comunidad:" class="mb-2"/>
                        <input type="text" id="neighborhood" v-model="form.neighborhood" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.neighborhood" />
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Ciudad:" class="mb-2"/>
                        <input type="text" id="city" v-model="form.city" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.city" />
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Estado:" class="mb-2"/>
                        <input type="text" id="state" v-model="form.state" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.state" />
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

const props = defineProps({
    data: Array
})


const open = ref(false)

const form = useForm({
  business_name: '',
  contact: '',
  phone : '',
  email : '',
  street: '',
  number: '',
  interior: '',
  neighborhood: '',
  city: '',
  state: ''
})

const module = ref('create')
const id = ref('')


const openModal = (data,type) => {
    open.value = true

    if(type == 'edit'){
        module.value = 'edit'
        id.value = data.id
        form.business_name = data.business_name
        form.contact = data.contact
        form.phone = data.phone
        form.email = data.email
        form.street = data.street
        form.number = data.number
        form.interior = data.interior
        form.neighborhood = data.neighborhood
        form.city = data.city
        form.state = data.state
    }else if(type == 'create'){
        module.value = 'create'
        form.business_name = ''
        form.contact = ''
        form.phone = ''
        form.email = ''
        form.street = ''
        form.number = ''
        form.interior = ''
        form.neighborhood = ''
        form.city = ''
        form.state = ''
    }else{
        module.value = 'delete'
        id.value = data.id
        form.business_name = data.business_name
        form.contact = data.contact
        form.phone = data.phone
        form.email = data.email
        form.street = data.street
        form.number = data.number
        form.interior = data.interior
        form.neighborhood = data.neighborhood
        form.city = data.city
        form.state = data.state
    }
}

const closeModal = () => {
    open.value = false
    form.reset()
}

const handleForm = () => {
    if(module.value == 'create'){
        form.post(route('caps.store'), {
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
        form.put(route('caps.update', id.value), {
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
        form.delete(route('caps.destroy', id.value), {
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
