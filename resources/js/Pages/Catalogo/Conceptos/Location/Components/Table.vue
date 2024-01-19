<template lang="">
    <DataTable :value="data" tableStyle="min-width: 9rem" :rowsPerPageOptions="[4,10,20]"  responsiveLayout="scroll" breakpoint="100px" :paginator="true" :rows="10" paginatorTemplate="PrevPageLink PageLinks NextPageLink RowsPerPageDropdown"
    currentPageReportTemplate="Ver {first} a {last} de {totalRecords}" v-model:filters="filters1">
        <template #header>
            <div class="flex justify-end gap-1 sm:max-sm:flex-col">
                <span class="p-input-icon-left">
                    <input type="text"  placeholder="Busqueda..." v-model="filters1['global'].value" class="shadow appearance-none border rounded w-full py-2 px-3 disabled:bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </span>
            </div>
        </template>
        <Column field="name" header="Localidad"></Column>
        <Column field="actions" header="Acciones">
            <template #body="{data}">
                <div class="flex justify-between gap-4">
                    <SecondaryButton v:type="button" class="w-full flex justify-center bg-orange-500 py-2 px-2 text-white" @click="emit('openModal',data,'edit')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </SecondaryButton>
                    <SecondaryButton :type="button" class="w-full flex justify-center bg-red-500 py-2 px-2 text-white" @click="emit('openModal',data,'delete')">
                        <i class="pi pi-trash" />
                    </SecondaryButton>
                </div>
            </template>
        </Column>
        <template #empty> No hay registros. </template>
    </DataTable>
</template>
<script setup>

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import {FilterMatchMode} from 'primevue/api';
import { ref } from 'vue';

const filters1 = ref({
    'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
});

const props = defineProps({
    data: Array
})

const modalDelete = (id) => {
    console.log(id)
}

const emit = defineEmits(["openModal"]);

</script>
