<template>
    <!--
    -->
    <div :class="`${customClass}`+' notebox p-8 text-left  border-solid  border-grey relative mb-3'">
        <button v-if="showStar" class="absolute pin-t pin-r text-xl hover:text-2xl p-2 font-bold text-green-dark">
            <i class="far fa-star"></i>
        </button>
        <div class=" text-left text-black font-bold">
            {{body}}
        </div>

        <div class="flex mt-4">
            <div class="flex-1" v-if="showCreatorDetails">
                <div class="text-black font-bold ">From {{author}}</div>
                <div class="uppercase">{{date}}</div>
            </div>

            <div class="flex-1 text-right pt-4">
                <button @click="showFullNoteModal" class="uppercase text-green-dark font-bold ml-2">
                    View More
                    <i class="fas fa-arrow-right"></i>
                </button>

            </div>

        </div>

        <modal
                width="30%"
                v-if="showFullNote"
                @close="showFullNote = false"
        >

            <div slot="header">
                <div class="text-xl text-black font-bold">
                    Note from {{author}}
                </div>
                <div class="text-grey text-sm -mb-1">
                    {{date}}
                </div>
                <button v-if="showStar" class="absolute pin-t pin-r text-xl hover:text-2xl px-3 py-4 font-bold text-green-dark">
                    <i class="far fa-star"></i>
                </button>
            </div>

            <div slot="body" class="row">
                <div class="text-black font-bold text-base pl-3">
                    {{body}}
                </div>
            </div>


        </modal>
    </div>

</template>


<script>
    import modal from '../modal/modal'

    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        components:{modal},
        props: {
            showModal:false,
            date: {
                type: String,
                default: 'Wednesday 12 November'
            },
            author: {
                type: String,
                default: 'Mohammad Karmi'
            },
            body: {
                type: String,
                default: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s\n' +
                '            standard dummy text ever since the 1500s, when an unknown printer\n' +
                '            took a galley of type and scrambled it to make a type specimen book.\n' +
                '            It has survived not only five centuries, but also the leap into electronic\n' +
                '            typesetting, remaining essentially unchanged'
            },
            showStar: {
                type: [Boolean, String],
                default: true
            },
            showCreatorDetails: {
                type: [Boolean, String],
                default: true
            },
            customClass: {
                type: [String],
                default: 'border'
            }
        },
        data(){
            return{
                showFullNote:false,
            }
        },
        methods:{
            showFullNoteModal(){
                this.showFullNote = true;
            }
        },
        mixins: []
    }
</script>

<style lang="scss">

</style>