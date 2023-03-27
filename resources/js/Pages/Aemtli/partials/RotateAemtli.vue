<script setup>
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const rotatingAemtli = ref(false);

const props = defineProps({
    key: Number,
    aemtlis: Object,
});

const rotateAemtliModal = () => {
    rotatingAemtli.value = true;
};

const form = useForm({
    rotation: temprotateAemtli(),
});

const headers = [
    {
        text: "Ämtli",
        align: "start",
        sortable: false,
        value: "aemtli",
    },
    { text: "alte Gruppe", value: "old_group_table" },
    { text: "neue Gruppe", value: "new_group_table" },
];

function temprotateAemtli() {
    const rotated = [];
    // CHECK!
    for (let i = 0; i < props.aemtlis.length; i++) {
        if (props.aemtlis[i].group === null) {
            return "Einem Ämtli wurde keine Gruppe zugeteilt :/ Findest du nicht, dass die Teilnehmenden Ämtli machen sollen?";
        }
        for (let j = 0; j < props.aemtlis.length; j++) {
            if (props.aemtlis[i].id === props.aemtlis[j].id) {
                break;
            } else if (
                props.aemtlis[i].group.id === props.aemtlis[j].group.id
            ) {
                return "Einer Gruppe wurden zwei Ämtlis zugeteilt :/ Ämtlis sind zwar toll, aber so fies müssen wir auch nicht sein.";
            }
        }
    }

    for (let i = 0; i < props.aemtlis.length; i++) {
        rotated.push({
            id: props.aemtlis[i].id,
            name: props.aemtlis[i].name,
            new_group: {
                name: props.aemtlis[(i + 1) % props.aemtlis.length].group.name,
                id: props.aemtlis[(i + 1) % props.aemtlis.length].group.id,
            },
            old_group: {
                name: props.aemtlis[i].group.name,
                id: props.aemtlis[i].group.id,
            },
            new_group_table:
                props.aemtlis[(i + 1) % props.aemtlis.length].group.name,
            old_group_table: props.aemtlis[i].group.name,
        });
    }
    return rotated;
}

const rotateAemtli = () => {
    form.post(route("aemtli.rotate"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => window.location.reload(),
    });
};

const closeModal = () => {
    rotatingAemtli.value = false;

    form.reset();
};
</script>

<template>
    <v-btn prepend-icon="sync" color="teal" @click="rotateAemtliModal">
        Ämtli rotieren
    </v-btn>

    <Modal :show="rotatingAemtli" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900">Rotiere die Ämtli!</h2>

            <p class="mt-1 mb-4 text-sm text-gray-600">
                Hier können die Ämtli rotiert werden, schau die Grafik an und
                überlege, ob das für dich Sinn macht!
            </p>

            <p
                v-if="typeof temprotateAemtli() === 'string'"
                class="text-red font-bold p-6"
            >
                {{ temprotateAemtli() }}
            </p>

            <v-table v-else class="m-4 mb-8">
                <thead>
                    <tr>
                        <th class="text-left">Ämtli</th>
                        <th class="text-left">alte Gruppe</th>
                        <th class="text-left">neue Gruppe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in temprotateAemtli()"
                        :key="item.id"
                        class="divide-x"
                    >
                        <td class="font-bold">{{ item.name }}</td>
                        <td class="text-red">{{ item.old_group_table }}</td>
                        <td class="text-green">{{ item.new_group_table }}</td>
                    </tr>
                </tbody>
            </v-table>

            <div class="flex justify-end gap-6">
                <v-btn prepend-icon="cancel" color="grey" @click="closeModal">
                    Abbrechen
                </v-btn>
                <v-btn
                    prepend-icon="check"
                    color="green"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="rotateAemtli"
                >
                    Rotieren
                </v-btn>
            </div>
        </div>
    </Modal>
</template>
