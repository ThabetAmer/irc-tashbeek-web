<template>
  <!--
    -->
  <div :class="panelStyle">
    <div
      v-if="title"
      class="text-black text-left font-bold text-xl mb-4"
    >
      {{ title }}
    </div>
    <slot />
  </div>
</template>


<script>

  import panelStyle from '../mixins/panelStyle'

  export default {
    name: "Panel",
    mixins: [panelStyle],
    /**
     * all props have their needed types
     * and are passed using the mixin
     */
    props: {
      hasTitle: {
        type: [Boolean, String],
        default: false
      },
      title: {
        type: String,
        default: null
      }
    }
  }
</script>

<style lang="scss">

</style>