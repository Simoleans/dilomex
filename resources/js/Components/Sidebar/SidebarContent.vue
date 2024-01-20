<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { DashboardIcon } from '@/Components/Icons/outline'
import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem.vue'
import { TemplateIcon } from '@heroicons/vue/outline'
</script>

<template>
    <PerfectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >
        <SidebarLink
            title="Inicio"
            :href="route('dashboard')"
            :active="route().current('dashboard')"
        >
            <template #icon>
                <DashboardIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <!-- <SidebarCollapsible
            title="Components"
            :active="route().current('components.*')"
        >
            <template #icon>
                <TemplateIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem
                :href="route('components.buttons')"
                title="Buttons"
                :active="route().current('components.buttons')"
            />
        </SidebarCollapsible> -->

        <SidebarCollapsible
            title="Adminstracion"
            :active="route().current('companies.*')"
        >
            <template #icon>
                <TemplateIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <!-- <SidebarCollapsibleItem
                :href="route('components.buttons')"
                title="Buttons"
                :active="route().current('components.buttons')"
            /> -->

            <!-- companies -->
            <SidebarCollapsibleItem
                :href="route('companies.index')"
                title="Empresas"
                :active="route().current('companies.*')"
            />
        </SidebarCollapsible>
        <hr>
        Catalogos
        <hr>
        <SidebarCollapsible
            title="Conceptos"
            :active="route().current('customer-type.*') || route().current('invoice-type.*') || route().current('distributions.*') || route().current('populations.*') || route().current('locations.*') || route().current('invoice-status.*') || route().current('rejection-codes.*')"
        >
            <template #icon>
                <i class="pi pi-book"></i>
            </template>

            <SidebarCollapsibleItem
                :href="route('customer-type.index')"
                title="Tipo de cliente"
                :active="route().current('customer-type.*')"
            />
            <!-- invoice type -->
            <SidebarCollapsibleItem
                :href="route('invoice-type.index')"
                title="Tipo de factura"
                :active="route().current('invoice-type.*')"
            />

            <!-- distribution -->
            <SidebarCollapsibleItem
                :href="route('distributions.index')"
                title="Repartos"
                :active="route().current('distributions.*')"
            />

            <!-- populations -->
            <SidebarCollapsibleItem
                :href="route('populations.index')"
                title="Poblacion"
                :active="route().current('populations.*')"
            />

            <!-- locations -->
            <SidebarCollapsibleItem
                :href="route('locations.index')"
                title="Localidad"
                :active="route().current('locations.*')"
            />

            <!-- invoice status -->
            <SidebarCollapsibleItem
                :href="route('invoice-status.index')"
                title="Estatus factura"
                :active="route().current('invoice-status.*')"
            />

            <!-- rejection code -->
            <SidebarCollapsibleItem
                :href="route('rejection-codes.index')"
                title="Codigos de rechazo"
                :active="route().current('rejection-code.*')"
            />
        </SidebarCollapsible>
        <SidebarCollapsible
            title="Tarifas"
            :active="route().current('families.*') || route().current('kilometer-cost.*') || route().current('company-cost.*') || route().current('foreign-transport-rates.*') || route().current('local-transport-rates.*') || route().current('company-travel.*')"
        >
            <template #icon>
                <i class="pi pi-sort-amount-up-alt"></i>
            </template>

            <SidebarCollapsibleItem
                :href="route('families.index')"
                title="Familias"
                :active="route().current('families.*')"
            />

            <!-- kilometer cost -->
            <SidebarCollapsibleItem
                :href="route('kilometer-cost.index')"
                title="Cobros por Kilometro"
                :active="route().current('kilometer-cost.*')"
            />

            <!-- company cost -->
            <SidebarCollapsibleItem
                :href="route('company-cost.index')"
                title="Cobros por Empresa"
                :active="route().current('company-cost.*')"
            />

            <!-- foreign transport rates -->
            <SidebarCollapsibleItem
                :href="route('foreign-transport-rates.index')"
                title="Tarifas foraneo de transporte"
                :active="route().current('foreign-transport-rates.*')"
            />

            <!-- local transport rates -->
            <SidebarCollapsibleItem
                :href="route('local-transport-rates.index')"
                title="Tarifas local de transporte"
                :active="route().current('local-transport-rates.*')"
            />

            <!-- company travel -->
            <SidebarCollapsibleItem
                :href="route('company-travel.index')"
                title="Viajes por empresa"
                :active="route().current('company-travel.*')"
            />

        </SidebarCollapsible>

        <SidebarCollapsible
            title="Transporte"
            :active="route().current('unit-type.*') || route().current('transport-contacts.*') || route().current('transport-lines.*')"
        >
            <template #icon>
                <i class="pi pi-car"></i>
            </template>

            <SidebarCollapsibleItem
                :href="route('unit-type.index')"
                title="Tipo de unidad"
                :active="route().current('unit-type.*')"
            />

            <!-- transport contact -->
            <SidebarCollapsibleItem
                :href="route('transport-contacts.page',1)"
                title="Ayudante/Chofer"
                :active="route().current('transport-contacts.*')"
            />

            <!-- transpor line -->
            <SidebarCollapsibleItem
                :href="route('transport-lines.index')"
                title="Linea de transporte"
                :active="route().current('transport-lines.*')"
            />

        </SidebarCollapsible>


        <!-- Examples -->
        <!--
        => External link example
        <SidebarLink
            title="Github"
            href="https://github.com/kamona-wd/kui-laravel-breeze"
            external
            target="_blank"
        >
        </SidebarLink>

        => Collapsible examples
        <SidebarCollapsible title="Users" :active="$page.url.startsWith('/users')">
            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="$page.url === '/users/index'" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="$page.url === '/users/create'" />
        </SidebarCollapsible>

        <SidebarCollapsible title="Users" :active="usePage().url.value.startsWith('/users')">
            <template #icon>
                <UserIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="route().current('users.index')" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="route().current('users.create')" />
        </SidebarCollapsible>-->
    </PerfectScrollbar>
</template>
