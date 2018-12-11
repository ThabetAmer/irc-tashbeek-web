<template>
    <!--
    -->
    <div :class="panelStyle">
        <div
                v-if="hasTitle"
                class="text-black text-left font-bold text-xl mb-3"
        >
            {{title}}
        </div>
        <slot></slot>
    </div>

</template>


<script>

    import panelStyle from '../../mixins/panelStyle'
    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props:{
            hasTitle:{
                type:[Boolean, String],
                default:false
            },
            title:{
                type:String,
                default:""
            }
        },
        mixins: [panelStyle]
    }
</script>

<style lang="scss">

</style>