<template>
  <!--
        button uses btnStyle to get primary class
        and theme class and size class and custom
        btn-class passed as prop.
        disabled is a prop.
        all events are emitted to the parent component.
        The slot is the btn text
    -->

  <button
    :class="btnStyle"
    :disabled="disabled"
    @blur="$emit('btn-blur')"
    @click="$emit('btn-click')"
    @focus="$emit('btn-focus')"
  >
    <slot name="text">
      button
    </slot>
  </button>
</template>


<script>
    import BtnStyleMixin from "../../mixins/BtnStyle"

    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        mixins: [BtnStyleMixin]
    }
</script>

<style lang="scss">

</style>