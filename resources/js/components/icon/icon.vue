<template>

    <i :class="customClass">

    </i>

</template>


<script>

    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props: {
            customClass:{
                type:String,
                default:''
            }
        },
        mixins: []
    }
</script>

<style lang="scss">

</style>