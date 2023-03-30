<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Abwaschen from "@/Components/aemtlis/Abwaschen.vue";
import Putzen from "@/Components/aemtlis/Putzen.vue";
import WC from "@/Components/aemtlis/WC.vue";
import Joker from "@/Components/aemtlis/Joker.vue";

const props = defineProps({
    abwaschen: Object,
    putzen: Object,
    wc: Object,
    joker_1: Object,
    joker_2: Object,
    joker_3: Object,
});

const abwaschen_group = props.abwaschen
    ? props.abwaschen.group
    : "keine Gruppe zugeteilt";

const putzen_group = props.putzen
    ? props.putzen.group
    : "keine Gruppe zugeteilt";

const wc_group = props.wc ? props.wc.group : "keine Gruppe zugeteilt";

const joker1_group = props.joker_1
    ? props.joker_1.group
    : "keine Gruppe zugeteilt";

const joker2_group = props.joker_2
    ? props.joker_2.group
    : "keine Gruppe zugeteilt";

const joker3_group = props.joker_3
    ? props.joker_3.group
    : "keine Gruppe zugeteilt";
</script>

<template>
    <Head title="Ämtliplan" />

    <div
        id="scrollbar"
        class="bg h-screen top-0 left-0 bottom-0 md:overflow-x-scroll overflow-y-hidden"
    >
        <div class="h-screen min-w-max grid grid-cols-3 grid-rows-2 gap-4 p-8">
            <Joker :group="joker1_group" :id="1" />
            <Joker :group="joker2_group" :id="2" />
            <Joker :group="joker3_group" :id="3" />
            <Putzen class="self-end" :group="putzen_group" />
            <Abwaschen class="self-end" :group="abwaschen_group" />
            <WC class="self-end" :group="wc_group" />
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
