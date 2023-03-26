<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    aemtlis: Object,
    groups: Object,
});

const form = useForm({
    aemtli: "",
    group: "",
});

for (let i = 0; i < props.aemtlis.length; i++) {
    if (props.aemtlis[i].group === null) {
        props.aemtlis[i].group = { name: undefined };
    }
}

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
        onSuccess: () => {
            for (let i = 0; i < props.aemtlis.length; i++) {
                if (props.aemtlis[i].group === null) {
                    props.aemtlis[i].group = { name: undefined };
                }
            }
        },
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

                    <div
                        v-for="aemtli in props.aemtlis"
                        class="border rounded p-6"
                    >
                        <h2 class="text-xl text-slate-600 mb-4">
                            Ämtli:
                            <span class="text-black font-bold">{{
                                aemtli.name
                            }}</span>
                        </h2>

                        <v-select
                            v-model="aemtli.group.name"
                            :items="availableGroups"
                            @update:modelValue="
                                changeGroup(aemtli.group, aemtli.name)
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
