<script>
import Cross from './svg/Cross.vue';

export default {
    components: {
        Cross
    },
    props: {
        show: Boolean,
        title: String,
    },
    methods: {
        close() {
            this.$emit('closeModal')
        }
    }
}
</script>

<template>
    <div v-show="show" class="border absolute top-0 left-0 w-full h-full bg-[#00000099] z-50 grid place-content-center">
        <div class="bg-white p-4 md:p-6 rounded-md w-[300px] md:w-[750px] border shadow shadow-black">
            <Cross @click="close()" class="hover:scale-[1.05] cursor-pointer w-8 h-8 ml-auto" stroke="#000000" stroke-width="1.5" fill="none" />
            <h1 class="text-2xl font-semibold" v-text="title"></h1>
            <slot name="content" />
        </div>
    </div>
</template>