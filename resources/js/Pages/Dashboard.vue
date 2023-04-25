<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import RotateAemtli from "@/Pages/Aemtli/partials/RotateAemtli.vue";
import { ref } from "vue";

const props = defineProps({
    aemtlis: Object,
    groups: Object,
});

const updateRotation = ref(0);

const form = useForm({
    aemtli: "",
    group: "",
});

function tempModel() {
    for (let i = 0; i < props.aemtlis.length; i++) {
        props.aemtlis[i].temp = props.aemtlis[i].group
            ? props.aemtlis[i].group.name
            : undefined;
    }
}
tempModel();

function getGroups(groups) {
    const temp = [];
    for (let i = 0; i < groups.length; i++) {
        temp.push(groups[i].name);
    }
    return temp;
}

const availableGroups = getGroups(props.groups);

function changeGroup(group, aemtli) {
    form.aemtli = aemtli;
    form.group = group;

    form.post(route("aemtli.change"), {
        preserveScroll: true,
        onFinish: () => tempModel(),
    });
}
</script>

<template>
    <Head title="Übersicht" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <h2 class="font-bold text-2xl mb-6">
                        Zuteilung Gruppen & Ämtli
                    </h2>

                    <div class="flex justify-end">
                        <RotateAemtli
                            :key="updateRotation.value"
                            :aemtlis="props.aemtlis"
                        />
                    </div>

                    <div
                        v-for="aemtli in props.aemtlis"
                        v-bind:key="aemtli.name"
                        class="border rounded p-6 mx-2 my-4"
                    >
                        <h2 class="text-xl text-slate-600 mb-4">
                            Ämtli:
                            <span class="text-black font-bold">{{
                                aemtli.name
                            }}</span>
                        </h2>

                        <v-select
                            v-model="aemtli.temp"
                            :items="availableGroups"
                            @update:modelValue="
                                changeGroup(aemtli.temp, aemtli.name);
                                tempModel();
                                updateRotation += 1;
                            "
                            clearable
                            label="Gruppe"
                        ></v-select>
                    </div>

                    <br />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
