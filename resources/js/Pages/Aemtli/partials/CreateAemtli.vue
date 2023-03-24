<script setup>
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { nextTick, ref } from "vue";

const creatingNewAemtli = ref(false);
const nameInput = ref(null);

const createNewAemtli = () => {
    creatingNewAemtli.value = true;

    nextTick(() => nameInput.value.focus());
};

const form = useForm({
    name: "",
});

const createAemtli = () => {
    form.post(route("aemtli.store"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => nameInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    creatingNewAemtli.value = false;

    form.reset();
};
</script>

<template>
    <v-btn prepend-icon="add" color="green" @click="createNewAemtli">
        neues Ämtli
    </v-btn>

    <Modal :show="creatingNewAemtli" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900">
                Erstelle neues Ämtli
            </h2>

            <p class="mt-1 mb-4 text-sm text-gray-600">
                Bei der Erstellung eines Ämtli kannst du diesem einen tollen
                Namen geben!
            </p>

            <v-text-field
                v-model="form.name"
                label="Ämtliname"
                ref="nameInput"
                required
            ></v-text-field>
            <InputError :message="form.errors.name" class="mt-2" />

            <div class="flex justify-end gap-6">
                <v-btn prepend-icon="cancel" color="grey" @click="closeModal">
                    Abbrechen
                </v-btn>
                <v-btn
                    prepend-icon="check"
                    color="green"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="createAemtli"
                >
                    Erstellen
                </v-btn>
            </div>
        </div>
    </Modal>
</template>
