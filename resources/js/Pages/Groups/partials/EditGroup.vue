<script setup>
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { ref } from "vue";

const editingGroup = ref(false);
const nameInput = ref(null);

const editGroup = () => {
    editingGroup.value = true;
};

const props = defineProps({
    group: Object,
});

function loadParticipants(participants) {
    const temp = [];
    for (let i = 0; i < participants.length; i++) {
        temp.push(participants[i].name);
    }

    return temp;
}

const newParticipant = () => {
    form.participants.push("");
};

function deleteParticipant(index) {
    form.participants.splice(index, 1);
}

const form = useForm({
    id: props.group.id,
    name: props.group.name,
    participants: loadParticipants(props.group.participants),
});

const updateGroup = () => {
    form.post(route("group.update"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    editingGroup.value = false;

    props.group.name = form.name;
};
</script>

<template>
    <v-icon
        icon="edit"
        color="blue"
        class="cursor-pointer"
        title="Gruppe bearbeiten"
        @click="editGroup"
    />

    <Modal :show="editingGroup" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900">
                Bearbeite eine Gruppe
            </h2>

            <p class="mt-1 mb-4 text-sm text-gray-600">
                Bearbeite hier den Namen und die Mitglieder einer Gruppe!
            </p>

            <v-text-field
                v-model="form.name"
                label="Gruppenname"
                required
            ></v-text-field>
            <InputError :message="form.errors.name" class="mt-2" />

            <p class="mt-1 mb-4 text-sm font-bold">Mitglieder</p>

            <div
                v-for="(participant, index) in form.participants"
                class="my-2 mx-4"
            >
                <v-text-field
                    v-model="form.participants[index]"
                    label="Mitglied"
                    ref="nameInput"
                    required
                    append-icon="cancel"
                    @click:append="deleteParticipant(index)"
                ></v-text-field>
            </div>

            <v-btn
                size="small"
                prepend-icon="add"
                color="blue"
                @click="newParticipant"
            >
                neues Mitglied
            </v-btn>

            <div class="flex justify-end gap-6 mt-6">
                <v-btn prepend-icon="cancel" color="grey" @click="closeModal">
                    Abbrechen
                </v-btn>
                <v-btn
                    prepend-icon="check"
                    color="green"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="updateGroup"
                >
                    Erstellen
                </v-btn>
            </div>
        </div>
    </Modal>
</template>
