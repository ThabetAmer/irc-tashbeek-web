<template>
    <!--
    -->
    <modal
            v-if="showModal"
            @close="showModal = false">
        <div slot="header">
            <h3>Add Note</h3>
            <btn

                    :theme="'success'"
                    :btnClass="'mb-2'"
                    @btn-click="showModal = false">
                <template slot="text">
                    Close
                </template>
            ></btn>
        </div>

    </modal>

</template>


<script>

    import modal from './modal'
    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props:{
            showModal:{
                type:Boolean,
                default:false
            }
        },
        data(){
            return{
                show:''
            }
        },
        created(){
            this.show = this.showModal;
        },

        mixins: [],
        components:{modal}
    }
</script>

<style lang="scss">

</style>