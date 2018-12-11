<template>
    <!--
    -->
    <div :class="`${customClass}`+' notebox p-8 text-left  border-solid  border-grey relative mb-3'">
        <button v-if="showStar"  class="absolute pin-t pin-r text-xl hover:text-2xl p-2 font-bold text-green-dark" >
            <i class="far fa-star"></i>
        </button>
        <div class=" text-left text-black font-bold">
            Lorem Ipsum is simply dummy text of the printing
            and typesetting industry. Lorem Ipsum has been the industry's
            standard dummy text ever since the 1500s, when an unknown printer
            took a galley of type and scrambled it to make a type specimen book.
            It has survived not only five centuries, but also the leap into electronic
            typesetting, remaining essentially unchanged
        </div>

        <div class="flex mt-4">
            <div class="flex-1" v-if="showCreatorDetails">
                <div class="text-black font-bold ">From Mohammad Karmi</div>
                <div class="uppercase">Wednesday 12 November</div>
            </div>

            <div class="flex-1 text-right pt-4">
                <button  class="uppercase text-green-dark font-bold ml-2">
                    View More
                    <i class="fas fa-arrow-right"></i>
                </button>

            </div>

        </div>

    </div>

</template>


<script>

    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props: {
            showStar:{
                type:[Boolean,String],
                default:true
            },
            showCreatorDetails:{
                type:[Boolean,String],
                default:true
            },
            customClass:{
                type:[String],
                default:'border'
            }
        },
        mixins: []
    }
</script>

<style lang="scss">

</style>