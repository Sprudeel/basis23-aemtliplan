<script setup>
import Tischen from "@/Components/svg/Tischen.vue";

const props = defineProps({
    group: Object,
});
</script>

<template>
    <div class="flex lg:flex-col-reverse gap-4">
        <Tischen
            class="h-20 w-20 lg:h-40 lg:w-40 self-center"
        />
        <div class="bg flex-col flex-1 opacity-0 p-2 woosh">
            <div v-if="group.name" class="text-center">
                <p class="font-bold text-lg lg:text-2xl lg:mb-2">{{ group.name }}</p>
                <p
                    v-for="participant in group.participants"
                    v-bind:key="participant.id"
                >
                    {{ participant.name }}
                </p>
            </div>
            <div v-else class="font-bold flex-grow-1 text-lg lg:text-2xl">{{ group }}</div>
        </div>
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
