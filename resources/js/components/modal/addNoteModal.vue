<template>
    <!--
    -->
    <modal
            v-if="showModal"
            @close="closeModal">
        <div slot="header" class="relative w-full text-left">
            <h3>Add Note</h3>
            <btn

                    :theme="'success'"
                    :btnClass="'mb-2 absolute pin-t pin-r rounded-full uppercase'"
                    @btn-click="addNote">
                <template slot="text">
                    Add Note
                </template>
            </btn>
        </div>


        <div slot="body">

            <customSelect
                    :label="'name'"
                    :options="SelectOptions"
                    track-by="name"
                    v-model="value"
                    @select="handleSelect"
                    placeholder="Type of follow-up"
                    customClass="w-1/2 bg-grey-lighter note-select"
            ></customSelect>

            <textarea rows="4" placeholder="Write note here..."
                      v-model="noteText"
                      class="w-full mt-2 bg-grey-lighter rounded p-2">

            </textarea>


        </div>

    </modal>

</template>


<script>

    import modal from './modal'
    import btn from '../button/button'
    import customSelect from '../select/select'
    import customInput from '../input/input'

    export default {
        /**
         * all props have their needed types
         * and are passed using the mixin
         */
        props: {
            showModal: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                value: '',
                show: '',
                noteText: '',
                SelectOptions: [
                    {name: 'Vue.js', language: 'JavaScript'},
                    {name: 'Rails', language: 'Ruby'},
                    {name: 'Sinatra', language: 'Ruby'},
                    {name: 'Laravel', language: 'PHP'},
                    {name: 'Phoenix', language: 'Elixir'}
                ],
            }
        },
        created() {
            this.show = this.showModal;
        },
        methods: {
            closeModal(){
                this.$emit('close');
            },
            addNote() {
                console.log('clicked on add note');
            },
            handleSelect(selected) {
                console.log('selected is ', selected);
                this.value = selected;
            },
        },
        mixins: [],
        components: {modal, btn, customSelect, customInput}
    }
</script>

<style lang="scss">

</style>