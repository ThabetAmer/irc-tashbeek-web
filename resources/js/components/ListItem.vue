<template>
  <li class="flex items-center border-b border-grey-light py-5 hd:text-sm xl:text-sm text-black ">
    <i
      :class="`min-w-20text-grey-darker mr-4 text-lg ${icon}`"
    />
    <slot />
  </li>
</template>

<script>
  import classNames from 'classnames'

  export default {
    components: {},
    props: {
      icon: {
        type: String,
        default: ''
      },
      displayData: {
        type: [Array, String],
        default: function () {
          return []
        }
      }
    },
    computed: {},
    methods: {}
  }
</script>

<style lang="scss">

</style>