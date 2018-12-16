<template>
    <!--
    -->
    <div class="">
       <panel customClass="relative px-3 py-4">
        <div class="absolute p-2 pin-t pin-r rounded-tr-lg bg-grey-lighter">
            <i :class="iconClasses" ></i>
        </div>
           <div class="count-number
                        pr-16 text-black
                        w-1/3 border-green-dark
                        text-left border-solid
                        font-bold border-b-4
                        text-2xl">
               {{value}}
           </div>

           <div class="text text-black
                        text-left font-bold
                        text-md mt-2 uppercase">
               {{label}}
           </div>
       </panel>
    </div>

</template>


<script>
    import panel from '../panel/panel'
    import classNames from "classnames"

    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props:{
            iconClass:{
                type:String,
                default:""
            },
            value:{
                type:[String,Number],
                default:0
            },
            label:{
                type:String,
                default:""
            }
        },
        computed:{
            iconClasses(){
                return classNames([this.iconClass,'text-3xl',
                    'text-green-dark' ]);
            }
        },
        components:{panel}
    }
</script>

<style lang="scss">

</style>