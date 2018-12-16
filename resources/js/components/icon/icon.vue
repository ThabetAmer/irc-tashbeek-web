<template>
  <i :class="customClass" />
</template>


<script>

    export default {
        mixins: [],
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props: {
            customClass:{
                type:String,
                default:''
            }
        }
    }
</script>

<style lang="scss">

</style>