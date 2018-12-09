<template>
    <!--

    -->
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container pl-12 relative"
                     :style="{width:width}"
                >
                    <a
                            href="javascript:void(0)"
                            @click="$emit('close')">
                        <i class="fas fa-times
                        absolute text-grey-dark
                        text-3xl mt-4 ml-4 pin-t pin-l"></i>
                    </a>
                    <div class="modal-header text-black font-bold border-none
                                ">
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
                        <slot name="footer">
                            default footer
                            <button class="modal-default-button" @click="$emit('close')">
                                OK
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>

</template>


<script>
    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props: {
            width:{
                type:String,
                default:"60%"
            }
        },
        mixins: []
    }
</script>

<style lang="scss">

</style>