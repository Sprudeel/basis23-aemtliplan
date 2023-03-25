<script setup>
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { ref } from "vue";

const creatingNewGroup = ref(false);

const createNewGroup = () => {
    creatingNewGroup.value = true;
};

const newParticipant = () => {
    form.participants.push("");
};

const form = useForm({
    name: "",
    participants: [],
});

const createGroup = () => {
    form.post(route("group.store"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    creatingNewGroup.value = false;

    form.reset();
};
</script>

<template>
    <v-btn prepend-icon="add" color="green" @click="createNewGroup">
        neue Gruppe
    </v-btn>

    <Modal :show="creatingNewGroup" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900">
                Erstelle eine neue Gruppe
            </h2>

            <p class="mt-1 mb-4 text-sm text-gray-600">
                Bei der Erstellung einer Gruppe kannst du dieser einen tollen
                Namen geben und die Mitglieder hinzufügen!
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
                ></v-text-field>
            </div>

            <v-btn
                size="small"
                prepend-icon="add"
                color="green"
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
                    @click="createGroup"
                >
                    Erstellen
                </v-btn>
            </div>
        </div>
    </Modal>
</template>
