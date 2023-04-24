<script setup>
import Joker from "@/Components/svg/Joker.vue";

const props = defineProps({
    group: Object,
    id: Number,
});
</script>

<template>
    <div class="m-4 relative flex lg:block min-w-screen">
        <Joker class="lg:mx-auto h-32 w-32 self-center lg:h-40 lg:w-40" />
        <div class="ml-4 lg:mb-4 bg flex-1 opacity-0 p-2 woosh">
            <div v-if="group.name" class="flex-grow-1">
                <p class="font-bold">{{ group.name }}</p>
                <p
                    class="text-center"
                    v-for="participant in group.participants"
                    v-bind:key="participant.id"
                >
                    {{ participant.name }}
                </p>
            </div>
            <div v-else class="font-bold flex-grow-1">{{ group }}</div>
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
        transform: translateY(-100px);
    }
    100% {
        opacity: 1;
        transform: translateY(0px);
    }
}
</style>
