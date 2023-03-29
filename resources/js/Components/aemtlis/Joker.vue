<script setup>
import Joker from "@/Components/svg/Joker.vue";

const props = defineProps({
    group: Object,
    id: Number,
});

function animate() {
    const element = document.getElementById("joker" + props.id + "_animate");
    element.classList.add("woosh");
}
</script>

<template>
    <div class="h-40 m-4 relative">
        <Joker class="mx-auto" @click="animate()" />
        <div
            :id="'joker' + props.id + '_animate'"
            class="mb-4 bg opacity-0 p-2"
        >
            <div v-if="group.name">
                <p class="font-bold">{{ group.name }}</p>
                <p
                    class="text-center"
                    v-for="participant in group.participants"
                >
                    {{ participant.name }}
                </p>
            </div>
            <div v-else class="font-bold">{{ group }}</div>
        </div>
    </div>
</template>

<style scoped>
.bg {
    background: rgba(255, 255, 255, 0.21);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(1.5px);
    -webkit-backdrop-filter: blur(1.5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.woosh {
    animation-name: woosh;
    animation-duration: 1s;
    animation-fill-mode: forwards;
}

@keyframes woosh {
    0% {
        opacity: 0;
        transform: translateY(-100px);
    }
    100% {
        opacity: 1;
        transform: translateY(0px);
    }
}
</style>
