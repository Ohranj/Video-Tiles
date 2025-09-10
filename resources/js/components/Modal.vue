<script>
    export default {
        props: {
            show: Boolean,
            title: String,
        }
    }
</script>

<template>
    <div v-show="show" class="border absolute top-0 left-0 w-full h-full bg-[#00000099] z-50 grid place-content-center">
        <div class="bg-white p-4 md:p-8 rounded-md w-[300px] md:w-[750px]">
            <h1 v-text="title"></h1>
            <div>
                <slot name="content" />
            </div>
        </div>
    </div>
</template>