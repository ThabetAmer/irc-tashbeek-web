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
      <h3>{{ 'irc.add_note' | trans }}</h3>
      <Btn
        :disabled="noteText === ''"
        :theme="'success'"
        :btn-class="`mb-2 absolute pin-t pin-r rounded-full uppercase ${noteText === '' ? 'cursor-not-allowed':'' }`"
        @click="addNote"
      >
        <template slot="text">
          {{ 'irc.add_note' | trans }}
        </template>
      </Btn>
    </div>


    <div slot="body">
      <CustomSelect
        v-model="value"
        :label="'name'"
        :options="SelectOptions"
        track-by="name"
        :placeholder="'irc.type_of_followup' | trans"
        custom-class="w-full md:w-1/2 bg-grey-lighter note-select"
        @select="handleSelect"
      />

      <textarea
        v-model="noteText"
        rows="4"
        :placeholder="'irc.write_note_here' | trans"
        class="w-full mt-2 bg-grey-lighter rounded p-2"
      />
    </div>
  </Modal>
</template>


<script>
    export default {

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
                    {label: 'Follow Up', name: 'follow_up'},
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
                this.$emit('note-added', this.noteText,this.value);
                this.$emit('close');

            },
            handleSelect(selected) {
                this.value = selected;
            },
        }
    }
</script>

<style lang="scss">

</style>