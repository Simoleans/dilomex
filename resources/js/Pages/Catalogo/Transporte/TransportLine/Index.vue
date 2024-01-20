<template lang="">
    <AuthenticatedLayout title="Linea de Transporte">
        <template #header>
            <div class="flex  gap-4 md:flex-row md:items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight">Linea de Transporte</h2>
                <button @click="openModal(false,'create')" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="pi pi-plus mr-2"></i>
                    <span>Crear Linea</span>
                </button>
            </div>
        </template>

        <div class="mt-4">
            <Table :data="data"  @openModal="openModal"/>
        </div>

        <Modal :show="open" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ module == 'create' ? 'Crear Linea' : (module == 'edit' ? 'Editar Linea' : 'Eliminar Linea') }}
                </h2>
                <hr class="m-5">
                <form @submit.prevent="handleForm">
                    <div class="mb-3">
                        <InputLabel value="Empresa:" class="mb-2"/>
                        <input type="text" v-model="form.company_name" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.company_name" />
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Domicilio:" class="mb-2"/>
                        <input type="text" v-model="form.address" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.address" />
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Telefono:" class="mb-2"/>
                        <input type="text" v-model="form.phone" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Contacto:" class="mb-2"/>
                        <input type="text" v-model="form.contact" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.contact" />
                    </div>
                    <div class="mb-3">
                        <InputLabel value="Email:" class="mb-2"/>
                        <input type="text" v-model="form.email" :disabled="module == 'delete'" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mb-3">
                        <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Linea propia:</h3>
                        <ul class="grid w-full gap-6 md:grid-cols-3">
                            <li :class="{'border-4 border-sky-500' : form.own_line}">
                                <input type="checkbox" id="react-option" name="own_line" v-model="form.own_line" class="hidden peer" :checked="form.own_line == 1"/>
                                <label for="react-option" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <div class="block">
                                        <i class="pi pi-plus-circle"></i>
                                        <div class="w-full text-lg font-semibold">Linea Propia</div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                        <InputError class="mt-2" :message="form.errors.own_line" />
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
    company_name: '',
    address: '',
    phone: '',
    contact : '',
    email : '',
    own_line : '',
})


const module = ref('create')
const id = ref('')


const openModal = (data,type) => {
    open.value = true

    if(type == 'edit'){
        module.value = 'edit'
        id.value = data.id
        form.company_name = data.company_name
        form.address = data.address
        form.phone = data.phone
        form.contact = data.contact
        form.email = data.email
        form.own_line = data.own_line

    }else if(type == 'create'){
        module.value = 'create'
        form.company_name = ''
        form.address = ''
        form.phone = ''
        form.contact = ''
        form.email = ''
        form.own_line = 0


    }else{
        module.value = 'delete'
        id.value = data.id
        form.company_name = data.company_name
        form.address = data.address
        form.phone = data.phone
        form.contact = data.contact
        form.email = data.email
        form.own_line = data.own_line

    }

    console.log(data,form)
}

const closeModal = () => {
    open.value = false
    form.reset()
}

const handleForm = () => {
    if(module.value == 'create'){
        form.post(route('transport-lines.store'), {
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
        form.put(route('transport-lines.update', id.value), {
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
        form.delete(route('transport-lines.destroy', id.value), {
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
