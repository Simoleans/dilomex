<template lang="">
    <AuthenticatedLayout title="Facturas">
        <!-- <template #header>
            <div class="flex  gap-4 md:flex-row md:items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight">Facturas</h2>
                <Link :href="route('invoices.create')" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="pi pi-plus mr-2"></i>
                    <span>Crear Factura</span>
                </Link>
            </div>
        </template> -->

        <div class="grid items-center gap-6 mt-4">
            <Table :data="data"/>
        </div>

    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Button from '@/Components/Button.vue'
import Table from './Components/Table.vue'
import { Link } from '@inertiajs/vue3'


const props = defineProps({
    data: Array,
})


</script>
