<template>
  <div class="flex items-center">
    <i :class="iconClass" />
    <span> test </span>
  </div>
</template>


<script>

  import iconMixin from "../../mixins/iconMixin";
  export default {
    mixins: [iconMixin],
    /**
     * all props have their needed types
     * and are passed using the mixin
     */
    props: {}
  }
</script>

<style lang="scss">

</style>