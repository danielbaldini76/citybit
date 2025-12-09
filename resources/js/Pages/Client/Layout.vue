<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const client = computed(() => page.props.client);
const user = computed(() => page.props.user ?? null);
</script>

<template>
    <div class="min-h-screen bg-slate-50">
        <header class="bg-white shadow-sm border-b border-slate-200">
            <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm text-slate-500 uppercase tracking-wide">CityBit</p>
                    <h1 class="text-xl font-semibold text-slate-900">Area Clienti – {{ client?.name }}</h1>
                    <p v-if="user" class="text-sm text-slate-600">Utente: {{ user.name }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <slot name="header-actions" />
                    <form
                        v-if="user"
                        :action="`/${client.slug}/logout`"
                        method="post"
                        class="ml-2"
                    >
                        <input type="hidden" name="_token" :value="page.props.csrf_token ?? ''" />
                        <button
                            type="submit"
                            class="inline-flex items-center rounded-md bg-slate-900 px-3 py-2 text-sm font-medium text-white shadow hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900"
                        >
                            Esci
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <main class="max-w-5xl mx-auto px-4 py-8">
            <slot />
        </main>
    </div>
</template>
