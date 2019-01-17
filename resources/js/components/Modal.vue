<template>
  <!--

    -->
  <Transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div
          :class="`modal-container pl-12 relative rounded ${customClass}` "
        >
          <a
            href="javascript:void(0)"
            @click="$emit('close')"
          >
            <i
              class="icon-X_x40_2xpng_2
                        absolute text-grey-dark
                        text-md mt-3 ml-2 md:text-xl md:mt-6 md:ml-4 pin-t pin-l"
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