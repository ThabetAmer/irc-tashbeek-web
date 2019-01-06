<template>
  <!--

    -->
  <Transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div
          :class="`modal-container pl-12 relative rounded ${customClass}` "
          :style="{width:width}"
        >
          <a
            href="javascript:void(0)"
            @click="$emit('close')"
          >
            <i
              class="icon-X_x40_2xpng_2
                        absolute text-grey-dark
                        text-xl mt-6 ml-4 pin-t pin-l"
            />
          </a>
          <div
            class="modal-header text-black font-bold border-none
                                "
          >
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              default body
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer" />
          </div>
        </div>
      </div>
    </div>
  </Transition>
</template>


<script>
    export default {
        mixins: [],
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props: {
            width:{
                type:String,
                default:"40%"
            },
          customClass:{
            type:String,
            default:""
          },
          bodyClass:{
            type:String,
            default:""
          }

        }
    }
</script>

<style lang="scss">

</style>