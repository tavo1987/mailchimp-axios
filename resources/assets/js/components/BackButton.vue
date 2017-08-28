<template>
    <div v-if="showBackButton" @click="$emit('back')">
        <button class="button"><slot></slot></button>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log(this.$listeners);
    },
    computed: {
        showBackButton() {
            return !! this.$listeners.back;
        }
    }
}
</script>

