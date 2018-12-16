<template>
  <!--
        link uses the same button mixin
        btnStyle is the primary link class
        plus theme plus btn-class passed as prop
        plus the btn-class which is a custom class.
        href is where the anchor leads to. Events
        are also handled here.the slot is the link text
    -->
  <a
    :href="linkRef"
    :class="btnStyle"
    :disabled="disabled"
    @blur="$emit('btn-blur')"
    @click="$emit('btn-click')"
    @focus="$emit('btn-focus')"
  >
    <slot name="text">
      Link
    </slot>
  </a>
</template>


<script>
    import BtnStyleMixin from "../../mixins/BtnStyle"
    export default {
        mixins:[BtnStyleMixin],
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props:{
            linkRef:{
              type:String,
              default:"javascript:void(0);"
          }
        }
    }
</script>

<style lang="scss">

</style>