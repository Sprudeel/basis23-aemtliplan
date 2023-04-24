<script setup>
import Putzen from "@/Components/svg/Putzen.vue";

const props = defineProps({
    group: Object,
});
</script>

<template>
    <div class="m-4 relativ flex gap-4 lg:flex-col min-w-screen">
        <div class="ml-4 lg:mb-4 bg flex-1 opacity-0 p-2 woosh">
            <div v-if="group.name" class="flex-grow-1">
                <p class="font-bold">{{ group.name }}</p>
                <p
                    class="text-center"
                    v-for="participant in group.participants"
                >
                    {{ participant.name }}
                </p>
            </div>
            <div v-else class="font-bold flex-grow-1">{{ group }}</div>
        </div>
        <Putzen
            class="h-32 w-32 lg:h-40 sm:order-first lg:order-1 lg:w-40 lg:mx-auto"
        />
    </div>
</template>

<style scoped>
.bg {
    background: rgba(255, 255, 255, 0.6);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}
.woosh {
    animation-name: woosh;
    animation-duration: 2s;
    animation-fill-mode: forwards;
}

@keyframes woosh {
    0% {
        opacity: 0;
        transform: translateY(100px);
    }
    100% {
        opacity: 1;
        transform: translateY(0px);
    }
}
</style>
