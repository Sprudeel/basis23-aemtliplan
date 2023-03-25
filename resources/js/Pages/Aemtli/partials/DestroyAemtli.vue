<script setup>
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

const destroyingAemtli = ref(false);

const props = defineProps({
    aemtli: Object,
});

const destroyAemtli = () => {
    destroyingAemtli.value = true;
};

const closeModal = () => {
    destroyingAemtli.value = false;
};
</script>

<template>
    <v-icon
        icon="delete_forever"
        color="red"
        class="cursor-pointer"
        title="Ämtli löschen"
        @click="destroyAemtli"
    />
    <Modal :show="destroyingAemtli" @close="closeModal">
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900">
                Ämtli "{{ aemtli.name }}" löschen?
            </h2>

            <p class="mt-1 mb-4 text-sm text-gray-600">
                Bist du dir sicher, dass du dieses Ämtli löschen willst?
            </p>

            <div class="flex justify-center gap-6">
                <v-btn prepend-icon="cancel" color="grey" @click="closeModal">
                    Abbrechen
                </v-btn>
                <Link
                    :href="`/aemtli/destroy/${aemtli.id}`"
                    title="Ämtli löschen"
                    method="post"
                    as="button"
                    preserve-scroll
                    ><v-btn prepend-icon="delete" color="red">
                        Löschen
                    </v-btn></Link
                >
            </div>
        </div>
    </Modal>
</template>
