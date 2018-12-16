<template>
  <!--
    -->
  <Modal
    v-if="showModal"
    @close="closeModal"
  >
    <div
      slot="header"
      class="relative w-full text-left mb-8"
    >
      <h3>Add Note</h3>
      <Btn

        :theme="'success'"
        :btn-class="'mb-2 absolute pin-t pin-r rounded-full uppercase'"
        @btn-click="addNote"
      >
        <template slot="text">
          Add Note
        </template>
      </Btn>
    </div>


    <div slot="body">
      <CustomSelect
        v-model="value"
        :label="'name'"
        :options="SelectOptions"
        track-by="name"
        placeholder="Type of follow-up"
        custom-class="w-1/2 bg-grey-lighter note-select"
        @select="handleSelect"
      />

      <textarea
        v-model="noteText"
        rows="4"
        placeholder="Write note here..."
        class="w-full mt-2 bg-grey-lighter rounded p-2"
      />
    </div>
  </Modal>
</template>


<script>


    import Modal from './modal'
    import btn from '../button/button'
    import CustomSelect from '../select/select'
    import CustomInput from '../input/input'

    export default {
        components: {Modal, btn, CustomSelect, CustomInput},
        mixins: [],
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
        watch: {
            showModal: function () {
                this.$set(this, 'value', '');
                this.$set(this, 'noteText', '');
            }
        },
        created() {
            this.show = this.showModal;
        },
        mounted() {
        },
        methods: {
            closeModal() {
                this.$emit('close');
                // this.$destroy();

            },
            addNote() {
                console.log('clicked on add note');
                this.$emit('note-added', this.noteText);
                this.$emit('close');

            },
            handleSelect(selected) {
                console.log('selected is ', selected);
                this.value = selected;
            },
        }
    }
</script>

<style lang="scss">

</style>