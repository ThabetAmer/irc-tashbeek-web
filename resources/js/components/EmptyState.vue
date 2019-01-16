<template>
  <div
    :class="`empty-state mt-4 flex  items-center  bg-grey-lighter ${customClass}`"
  >
    <slot
      name="empty-label"
    >
      <div class="mx-auto text-grey-dark mb-2">
        {{ message | trans }}
        <i :class="icon" />
      </div>
    </slot>
  </div>
</template>

<script>
  import classNames from 'classnames'

  export default {
    components: {},
    props: {
      icon: {
        type: String,
        default: null
      },
      message: {
        type: String,
        default: 'irc.no_data_to_present'
      },
      customClass: {
        type: String,
        default: ''
      }
    },
    computed: {},
    methods: {}
  }
</script>

<style lang="scss">

</style>