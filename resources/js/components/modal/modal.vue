<template>
    <!--

    -->
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container" :style="{width:width}">
                    <div class="modal-header">
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