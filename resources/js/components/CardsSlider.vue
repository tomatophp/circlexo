<template>
    <swiper :effect="'cards'" :grabCursor="true" :modules="modules" class="w-64">
        <slot />
    </swiper>
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css/effect-cards';

// import required modules
import { EffectCards } from 'swiper/modules';

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [EffectCards],
        };
    },
};
</script>