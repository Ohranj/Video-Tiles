<script>
import GuestLayout from '../Layouts/Guest.vue'

export default {
    components: {
        GuestLayout
    }
}
</script>

<template>
    <GuestLayout>
        <template v-slot:content>
            <h2 class="font-semibold text-lg">Welcome.</h2>
        </template>
    </GuestLayout>
</template>