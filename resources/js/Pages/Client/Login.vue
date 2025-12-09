<script setup>
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const client = computed(() => page.props.client);

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(`/${client.value.slug}/login`);
};
</script>

<template>
    <Head :title="`Area Clienti – ${client?.name ?? ''}`" />
    <div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md bg-white shadow-sm rounded-lg border border-slate-200 p-8 space-y-6">
            <div class="text-center space-y-2">
                <p class="text-sm uppercase tracking-wide text-slate-500">CityBit</p>
                <h1 class="text-2xl font-semibold text-slate-900">Area Clienti – {{ client?.name }}</h1>
                <p class="text-sm text-slate-600">Accedi per visualizzare la tua dashboard</p>
            </div>

            <form class="space-y-4" @submit.prevent="submit">
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-slate-700" for="email">Email</label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        required
                        class="w-full rounded-md border-slate-300 focus:border-slate-500 focus:ring-slate-500"
                    />
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-slate-700" for="password">Password</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        autocomplete="current-password"
                        required
                        class="w-full rounded-md border-slate-300 focus:border-slate-500 focus:ring-slate-500"
                    />
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2 text-sm text-slate-700">
                        <input
                            v-model="form.remember"
                            type="checkbox"
                            class="rounded border-slate-300 text-slate-900 focus:ring-slate-600"
                        />
                        <span>Ricordami</span>
                    </label>
                </div>

                <div v-if="form.hasErrors" class="rounded-md border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        <li v-for="(message, key) in form.errors" :key="key">{{ message }}</li>
                    </ul>
                </div>

                <button
                    type="submit"
                    class="w-full inline-flex justify-center rounded-md bg-slate-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900"
                    :disabled="form.processing"
                >
                    {{ form.processing ? 'Accesso in corso...' : 'Accedi' }}
                </button>
            </form>
        </div>
    </div>
</template>
