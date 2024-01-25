<template lang="">
    <AuthenticatedLayout title="Estatus de factura">
        <template #header>
            <div class="flex  gap-4 md:flex-row md:items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight">Crear factura</h2>
               <!--  <button @click="openModal(false,'create')" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="pi pi-plus mr-2"></i>
                    <span>Crear Estatus de Factura</span>
                </button> -->
            </div>
        </template>

        <div class="flex gap-2 w-full p-5 bg-gray-100 dark:bg-gray-700 rounded-md shadow-lg">
            <form @submit.prevent="handleForm" class="w-full">
                <div class="grid grid-cols-1 ">
                    <InputLabel value="Empresa:" class="mb-2"/>
                    <Dropdown @change="searchCustomers" v-model="form.company_id" filter :options="companies" optionValue="id" optionLabel="name" placeholder="Selecciona una empresa" class="w-full md:w-14rem border-1 border-sky-500" />
                    <InputError class="mt-2" :message="form.errors.company_id" />
                </div>
                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                <transition name="fade">
                    <div class="grid md:lg:grid-cols-2 grid-cols-1 gap-4 w-full" v-show="showForm">
                        <div class="mb-3">
                            <div class="mb-3">
                                <InputLabel value="Cliente: (*)" class="mb-2"/>
                                <Dropdown @click="handleCustomer" v-model="form.customer_id" filter :options="customers" optionValue="id" optionLabel="name" placeholder="Selecciona una empresa" class="w-full md:w-14rem border-1 border-sky-500">
                                    <template #option="slotProps">
                                        <div class="flex align-items-center" @click="selectCustomer(slotProps.option)">
                                            <div>{{ slotProps.option.name }} - {{ slotProps.option.code}}</div>
                                        </div>
                                    </template>
                                </Dropdown>
                                <InputError class="mt-2" :message="form.errors.customer_id" />
                            </div>
                            <div class="mb-3">
                                <InputLabel value="Territorio:" class="mb-2"/>
                                <input type="text" v-model="form.name" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div class="mb-3">
                                <InputLabel value="Concentrado:  (*)" class="mb-2"/>
                                <input type="text" v-model="form.concentrated" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <InputError class="mt-2" :message="form.errors.concentrated" />
                            </div>
                            <div class="mb-3">
                                <InputLabel value="Facturas:  (*)" class="mb-2"/>
                                <input type="text" v-model="form.code_invoice" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <InputError class="mt-2" :message="form.errors.code_invoice" />
                            </div>
                            <div class="flex gap-5">
                                <div class="mb-3 w-full">
                                    <InputLabel value="Cajas:(*)" class="mb-2"/>
                                    <input type="number" v-model="form.box_invoice" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <InputError class="mt-2" :message="form.errors.box_invoice" />
                                </div>
                                <div class="mb-3 w-full">
                                    <InputLabel value="Peso:" class="mb-2"/>
                                    <input type="number" v-model="form.weight" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <InputError class="mt-2" :message="form.errors.weight" />
                                </div>
                            </div>
                            <div class="mb-3 w-full">
                                <InputLabel value="Precio:" class="mb-2"/>
                                <input type="number" step="0.01" v-model="form.price" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>
                            <div class="grid grid-cols-2 gap-5">
                                <div class="mb-3 w-full">
                                    <InputLabel value="Estado:" class="mb-2"/>
                                    <Dropdown v-model="form.invoice_status_id" filter :options="invoiceStatus" optionValue="id" optionLabel="name" placeholder="Selecciona un Estatus" class="w-full md:w-14rem border-1 border-sky-500" />
                                    <InputError class="mt-2" :message="form.errors.invoice_status_id" />
                                </div>
                                <div class="mb-3 w-full">
                                    <InputLabel value="Tipo de Factura:" class="mb-2"/>
                                    <Dropdown v-model="form.invoice_type_id" filter :options="invoiceTypes" optionValue="id" optionLabel="name" placeholder="Selecciona un" class="w-full md:w-14rem border-1 border-sky-500" />
                                    <InputError class="mt-2" :message="form.errors.invoice_type_id" />
                                </div>
                            </div>
                            <div class="mb-3 w-full">
                                <InputLabel value="Pedido:" class="mb-2"/>
                                <input type="text" v-model="form.order" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <InputError class="mt-2" :message="form.errors.order" />
                            </div>
                            <div class="mb-3 w-full">
                                <InputLabel value="Familia(*):" class="mb-2"/>
                                <Dropdown v-model="form.family_id" filter :options="families" optionValue="id" optionLabel="name" placeholder="Selecciona una empresa" class="w-full md:w-14rem border-1 border-sky-500" />
                                <InputError class="mt-2" :message="form.errors.family_id" />
                            </div>
                            <div class="grid grid-cols-2 gap-5">
                                <div class="mb-3 w-full">
                                    <InputLabel value="Faltantes:" class="mb-2"/>
                                    <Checkbox @click="handleMissing" />
                                </div>
                                <div class="mb-3 w-full" v-show="checkMissing" >
                                    <div>
                                        <InputLabel value="Cajas:" class="mb-2"/>
                                        <input type="number" step="0.01" v-model="form.box_missing" :disabled="!checkMissing" :required="checkMissing" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div>
                                        <InputLabel value="Piezas:" class="mb-2"/>
                                        <input type="number" step="0.01" v-model="form.part_missing" :disabled="!checkMissing" :required="checkMissing" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div>
                                        <InputLabel value="Observaciones:" class="mb-2"/>
                                        <input type="text" v-model="form.observations_missing" :disabled="!checkMissing" :required="checkMissing" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <transition name="fade">
                                <div class="col-span-2 " v-show="showCustomer">
                                    <InputLabel value="Cliente:" class="mb-2"/>
                                    <div class="w-full border-dashed border-2 rounded-md border-green-700 dark:border-green-600 bg-green-200 dark:bg-green-300 p-4 dark:text-black">
                                        <span>Cliente Seleccionado</span>
                                        <div class="grid gap-2">
                                            <div class="text-lg font-semibold">{{infoCustomer.name}}</div>
                                            <div class="text-sm font-semibold">{{infoCustomer.code}}</div>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                            <div class="mb-3">
                                <InputLabel value="F. Concentrado:(*)" class="mb-2"/>
                                <input type="date" v-model="form.date_concentrated" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <InputError class="mt-2" :message="form.errors.date_concentrated" />
                            </div>
                            <div class="mb-3">
                                <InputLabel value="F. Factura:(*)" class="mb-2"/>
                                <input type="date" v-model="form.date_invoice" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <InputError class="mt-2" :message="form.errors.date_invoice" />
                            </div>
                            <div class="mb-3">
                                <InputLabel value="Piezas:" class="mb-2"/>
                                <input type="number" step="0.01" v-model="form.part_invoice" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <InputError class="mt-2" :message="form.errors.part_invoice" />
                            </div>
                            <div class="mb-3">
                                <div class="flex align-items-center">
                                    <RadioButton v-model="form.currency" id="MXN" name="pizza" value="MXN" />
                                    <label for="MXN" class="ml-2">Pesos</label>
                                </div>
                                <div class="flex align-items-center">
                                    <RadioButton v-model="form.currency" id="USD" name="pizza" value="USD" />
                                    <label for="USD" class="ml-2">Dolares</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <InputLabel value="F. Porteo:(*)" class="mb-2"/>
                                <input type="date" required v-model="form.date_portage" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <InputError class="mt-2" :message="form.errors.date_portage" />
                            </div>
                            <div class="mb-3">
                                <InputLabel value="Cita:(*)" class="mb-2"/>
                                <input type="date" required v-model="form.date_date" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <InputError class="mt-2" :message="form.errors.date_date" />
                            </div>
                            <!-- textarea for observations_invoice-->
                            <div class="mb-3">
                                <InputLabel value="Observaciones:" class="mb-2"/>
                                <textarea v-model="form.observations_invoice" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                                <InputError class="mt-2" :message="form.errors.observations_invoice" />
                            </div>
                            <div class="grid grid-cols-2 gap-5">
                                <div class="mb-3 w-full">
                                    <InputLabel value="Codigo de barras:" class="mb-2"/>
                                    <Checkbox @click="handleBarCode" />
                                </div>
                                <div class="mb-3 w-full" v-show="checkBarCode" >
                                    <div>
                                        <InputLabel value="Codigo de Barras:" class="mb-2"/>
                                        <input type="text" v-model="form.barcode" :disabled="!checkBarCode" :required="checkBarCode" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>

                <div class="flex items-center justify-end gap-4 mt-6">
                    <button
                        class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button">
                            Borrar
                    </button>
                    <button :class="{ 'opacity-25': form.processing, 'bg-red-600' : module == 'delete' }"
                        :disabled="form.processing || !showForm"
                        class="bg-blue-500 hover:bg-blue-700 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                           Guardar Factura
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Button from '@/Components/Button.vue'
import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Input from '@/Components/Input.vue'
import { useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import toast from "@/Stores/toast";
import { usePage } from '@inertiajs/vue3'
import Dropdown from 'primevue/dropdown';
import Checkbox from '@/Components/Checkbox.vue'
import RadioButton from 'primevue/radiobutton';



const props = defineProps({
    companies: Array,
    invoiceStatus: Array,
    invoiceTypes: Array,
    families : Array,
})


const open = ref(false)

const form = useForm({
  code_invoice: '',
  invoice_type_id: '',
  customer_id: '',
  company_id: '',
  family_id: '',
  invoice_status_id: '',
  territory: '',
  box_invoice: '',
  concentrated: '',
  weight: '',
  order: '',
  price: 0,
  box_missing: '',
  part_missing: '',
  observations_missing: '',
  date_concentrated: '',
  date_invoice: '',
  date_portage: '',
  date_date: '',
  part_invoice: '',
  volume: '',
  currency: 'MXN', // Default value
  observations_invoice: '',
  barcode: ''
});

const module = ref('create')
const id = ref('')
const infoCustomer = ref({})
const customers = ref([])
const showCustomer = ref(false)
const showForm = ref(false)
const checkMissing = ref(false)
const checkBarCode = ref(false)

const handleCustomer = () => {
    if(form.company_id == ''){
        toast.add({
            message: 'Selecciona una empresa',
            type: 'error'
        });
    }
}

const selectCustomer = (customer) => {
    showCustomer.value = true;
    form.customer_id = customer.id;
    infoCustomer.value = { ...customer };

};

const searchCustomers = async () => {
    showCustomer.value = false
    showForm.value = true
    axios.post(route('getCustomers.company',form.company_id))
    .then(function (response) {
        customers.value = response.data
    })
    .catch(function (error) {
        toast.add({
            message: 'Error',
            type: 'error'
        });
    });
}

const handleMissing = () => {
    checkMissing.value = !checkMissing.value
}

const handleBarCode = () => {
    checkBarCode.value = !checkBarCode.value
}

const handleForm = () => {
        form.post(route('invoices.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.add({
                message: usePage().props.toast.message,
                type: usePage().props.toast.type
            });
            closeModal()
        }
    })
}

</script>
<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.4s ease;
    }

    .fade-enter-from, .fade-leave-to {
        opacity: 0;
    }

</style>
