<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { MailIcon, LockClosedIcon, LoginIcon } from '@heroicons/vue/outline'
import InputIconWrapper from '@/Components/InputIconWrapper.vue'
import Button from '@/Components/Button.vue'
import Checkbox from '@/Components/Checkbox.vue'
import GuestLayout from '@/Layouts/Guest.vue'
import Input from '@/Components/Input.vue'
import Label from '@/Components/Label.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'

defineProps({
    canResetPassword: Boolean,
    status: String,
})

const form = useForm({
    username: '',
    password: '',
    remember: false
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <GuestLayout title="Log in">
        <ValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="grid gap-6">
                <div class="space-y-2">
                    <Label for="username" value="Usuario" />
                    <InputIconWrapper>
                        <template #icon>
                            <MailIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="username"  class="block w-full" placeholder="Usuario" v-model="form.username" required autofocus autocomplete="username" />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="password" value="Contraseña" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="password" type="password" class="block w-full" placeholder="Contraseña" v-model="form.password" required autocomplete="current-password" />
                    </InputIconWrapper>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Recordar</span>
                    </label>

                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-blue-500 hover:underline">
                        Olvidaste tu clave?
                    </Link>
                </div>

                <div>
                    <Button class="justify-center gap-2 w-full" :disabled="form.processing" v-slot="{iconSizeClasses}">
                        <LoginIcon aria-hidden="true" :class="iconSizeClasses" />
                        <span>Entrar</span>
                    </Button>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    No tienes cuenta??
                    <Link :href="route('register')" class="text-blue-500 hover:underline">
                        Registrate
                    </Link>
                </p>
            </div>
        </form>
    </GuestLayout>
</template>
