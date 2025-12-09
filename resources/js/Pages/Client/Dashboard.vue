<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Layout from './Layout.vue';

const page = usePage();
const client = computed(() => page.props.client);
const sensors = computed(() => page.props.sensors ?? []);
</script>

<template>
    <Head :title="`Dashboard – ${client?.name ?? ''}`" />
    <Layout>
        <template #header-actions>
            <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 border border-slate-200">
                {{ sensors.length }} sensori
            </span>
        </template>

        <div class="grid gap-4 md:grid-cols-2">
            <div
                v-for="sensor in sensors"
                :key="sensor.id"
                class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm flex flex-col gap-3"
            >
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">{{ sensor.type }}</p>
                        <h2 class="text-lg font-semibold text-slate-900">{{ sensor.name }}</h2>
                    </div>
                    <span
                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold"
                        :class="{
                            'bg-emerald-100 text-emerald-700': sensor.status === 'ok',
                            'bg-amber-100 text-amber-700': sensor.status === 'warning',
                            'bg-rose-100 text-rose-700': sensor.status === 'alarm',
                        }"
                    >
                        {{ sensor.status }}
                    </span>
                </div>
                <div class="flex items-center justify-between text-sm text-slate-700">
                    <div>
                        <p class="text-slate-500">Ultimo valore</p>
                        <p class="font-semibold">{{ sensor.last_value }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-slate-500">Aggiornato</p>
                        <p class="font-semibold">{{ sensor.updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
