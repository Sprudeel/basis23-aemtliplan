<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CreateAemtli from "@/Pages/Aemtli/partials/CreateAemtli.vue";
import EditAemtli from "@/Pages/Aemtli/partials/EditAemtli.vue";
import DestroyAemtli from "@/Pages/Aemtli/partials/DestroyAemtli.vue";

const props = defineProps({
    aemtlis: Object,
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
                            Ämtli
                        </h2>
                        <CreateAemtli />
                    </div>

                    <div
                        class="p-6 border m-4 rounded relative"
                        v-for="aemtli in aemtlis"
                        :key="aemtli.id"
                    >
                        <h2
                            class="font-semibold text-2xl text-gray-800 leading-tight"
                        >
                            {{ aemtli.name }}
                        </h2>
                        <div
                            class="flex lg:justify-between flex-col lg:flex-row"
                        >
                            <span
                                ><span class="text-xm text-slate-500"
                                    >derzeitige Gruppe:
                                    <span
                                        class="text-black"
                                        v-if="aemtli.group"
                                        >{{ aemtli.group.name }}</span
                                    >
                                    <span class="text-black" v-else
                                        >keine Gruppe</span
                                    >
                                </span></span
                            >
                            <span
                                ><span class="text-xm text-slate-500"
                                    >Component:
                                    <span
                                        class="text-black"
                                        v-if="aemtli.component"
                                        >{{ aemtli.component }}</span
                                    >
                                    <span class="text-black" v-else
                                        >kein Component</span
                                    >
                                </span></span
                            >
                            <span
                                ><span class="text-xm text-slate-500"
                                    >letzter Wechsel: </span
                                >{{ formatDate(aemtli.updated_at) }}</span
                            >
                        </div>
                        <div class="flex gap-4 absolute top-6 right-6">
                            <EditAemtli :aemtli="aemtli" />
                            <DestroyAemtli :aemtli="aemtli" />
                        </div>
                    </div>

                    <div class="p-6 m-4"></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
