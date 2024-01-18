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
            :active="route().current('customer-type.*') || route().current('invoice-type.*') || route().current('distributions.*') || route().current('populations.*') || route().current('locations.*')"
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
