<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CreateGroup from "@/Pages/Groups/partials/CreateGroup.vue";
import EditGroup from "@/Pages/Groups/partials/EditGroup.vue";
import DestroyGroup from "@/Pages/Groups/partials/DestroyGroup.vue";

const props = defineProps({
    groups: Object,
});

function formatDate(dateString) {
    const date = new Date(dateString);
    // Then specify how you want your dates to be formatted
    return new Intl.DateTimeFormat("default", { dateStyle: "long" }).format(
        date
    );
}
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
                            Gruppen
                        </h2>
                        <CreateGroup />
                    </div>

                    <div
                        class="p-6 border m-4 rounded relative"
                        v-for="group in groups"
                        :key="group.id"
                    >
                        <h2
                            class="font-semibold text-2xl text-gray-800 leading-tight"
                        >
                            {{ group.name }}
                        </h2>
                        <div class="flex flex-col">
                            <span
                                ><span class="text-xm text-slate-500"
                                    >Ämtli:</span
                                ></span
                            >

                            <div>
                                <span class="text-xm text-slate-500"
                                    >Mitglieder: &nbsp;
                                </span>
                                <span v-for="participant in group.participants">
                                    {{ participant.name }}, &nbsp;
                                </span>
                            </div>
                            <span
                                ><span class="text-xm text-slate-500"
                                    >Erstellt: </span
                                >{{ formatDate(group.created_at) }}</span
                            >
                        </div>
                        <div class="flex gap-4 absolute top-6 right-6">
                            <EditGroup :group="group" />
                            <DestroyGroup :group="group" />
                        </div>
                    </div>

                    <div class="p-6 m-4"></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
