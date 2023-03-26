<script setup>
import Modal from "@/Components/Modal.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { nextTick, ref } from "vue";

const editingAemtli = ref(false);
const nameInput = ref(null);

const editAemtli = () => {
    editingAemtli.value = true;

    nextTick(() => nameInput.value.focus());
};

const props = defineProps({
    aemtli: Object,
});

const form = useForm({
    id: props.aemtli.id,
    name: props.aemtli.name,
    group: props.aemtli.group,
});

const updateAemtli = () => {
    form.post(route("aemtli.update"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => nameInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    editingAemtli.value = false;

    props.aemtli.name = form.name;
};
</script>

<template>
    <v-icon
        icon="edit"
        color="blue"
        class="cursor-pointer"
        title="Ämtli bearbeiten"
        @click="editAemtli"
    />

    <Modal :show="editingAemtli" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900">
                Bearbeite Ämtli "{{ props.aemtli.name }}"
            </h2>

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
                    @click="updateAemtli"
                >
                    Erstellen
                </v-btn>
            </div>
        </div>
    </Modal>
</template>
