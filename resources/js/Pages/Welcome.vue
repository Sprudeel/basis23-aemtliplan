<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Abwaschen from "@/Components/aemtlis/Abwaschen.vue";
import Putzen from "@/Components/aemtlis/Putzen.vue";
import Tischen from "@/Components/aemtlis/Tischen.vue";
import Joker from "@/Components/aemtlis/Joker.vue";

const props = defineProps({
    abwaschen: Object,
    putzen: Object,
    tischen: Object,
    joker_1: Object,
    joker_2: Object,
    joker_3: Object,
});

const abwaschen_group = props.abwaschen.group ?? "keine Gruppe zugeteilt";

const putzen_group = props.putzen.group ?? "keine Gruppe zugeteilt";

const tischen_group = props.tischen.group ?? "keine Gruppe zugeteilt";

const joker1_group = props.joker_1.group ?? "keine Gruppe zugeteilt";

const joker2_group = props.joker_2.group ?? "keine Gruppe zugeteilt";

const joker3_group = props.joker_3.group ?? "keine Gruppe zugeteilt";
</script>

<template>
    <Head title="Ämtliplan" />

    <div
        id="scrollbar"
        class="bg"
    >
        <div
            class="min-h-screen flex flex-col lg:grid grid-cols-1 lg:grid-cols-3 grid-rows-6 lg:grid-rows-2 gap-4 p-4 lg:p-8"
        >
            <Joker class="lg:self-start" :group="joker1_group" :id="1" />
            <Joker class="lg:self-start" :group="joker2_group" :id="2" />
            <Joker class="lg:self-start" :group="joker3_group" :id="3" />
            <Putzen class="lg:self-end" :group="putzen_group" />
            <Abwaschen class="lg:self-end" :group="abwaschen_group" />
            <Tischen class="lg:self-end" :group="tischen_group" />
        </div>
    </div>
</template>

<style>
.bg {
    background-image: url("../../images/hintergrund.png");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: bottom;
}

#scrollbar::-webkit-scrollbar {
    width: 12px;
    height: 8px;
    display: block;
}

#scrollbar::-webkit-scrollbar-track {
    border-radius: 4px;
    background-color: #e7e7e7;
    border: 1px solid #cacaca;
    box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.3);
}

#scrollbar::-webkit-scrollbar-thumb {
    border-radius: 8px;
    background-color: #363636;
}
</style>
