<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Ämtli" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ämtli
            </h2>
        </template> -->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-between p-6">
                        <h2
                            class="font-bold text-3xl text-gray-800 leading-tight"
                        >
                            Ämtli
                        </h2>
                        <v-btn prepend-icon="add" color="green">
                            neues Ämtli
                        </v-btn>
                    </div>

                    <div class="p-6 border m-4 rounded relative">
                        <h2
                            class="font-semibold text-2xl text-gray-800 leading-tight"
                        >
                            Abwaschen
                        </h2>
                        <div
                            class="flex lg:justify-between flex-col lg:flex-row"
                        >
                            <span
                                ><span class="text-xm text-slate-500"
                                    >derzeitige Gruppe:</span
                                ></span
                            >
                            <span
                                ><span class="text-xm text-slate-500"
                                    >letzter Wechsel:</span
                                ></span
                            >
                        </div>
                        <div class="flex gap-4 absolute top-6 right-6">
                            <v-icon
                                icon="edit"
                                color="blue"
                                class="cursor-pointer"
                                title="Ämtli bearbeiten"
                            />
                            <v-icon
                                icon="delete_forever"
                                color="red"
                                class="cursor-pointer"
                                title="Ämtli löschen"
                            />
                        </div>
                    </div>

                    <div class="p-6 m-4"></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
