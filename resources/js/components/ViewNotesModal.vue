<template>
  <!--
    -->
  <Modal
    v-if="showModal"
    custom-class="max-h-400 overflow-y-auto"
    @close="closeModal"
  >
    <div
      slot="header"
      class="relative w-full text-left mb-8"
    >
      <div class=" text-lg text-grey-darker">
        All Notes
      </div>
    </div>


    <div slot="body">
      <EmptyState
        v-if="notes.length === 0 && !loading"
        icon="icon-Note_x40_2xpng_2 text-3xl mt-3 block"
        message="You don't have any notes!"
        custom-class="mt-5 min-h-200 text-lg"
      />
      <PageLoader
        v-else-if="notes.length === 0 && loading"
        message="Notes are being fetched"
      />
      <div v-else>
        <Notebox
          v-for="note in notes"
          :id="note.id"
          :key="note.id"
          :show-star="false"
          :date="note.created_at_text"
          :author="note.user.name"
          :body="note.note"
        />
      </div>
    </div>
  </Modal>
</template>


<script>
  import {get as getNotes} from '../api/noteAPI'
  import Vue from 'vue'

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
      },
      caseType: {
        type: String,
        required: true
      },
      caseId: {
        type: Number,
        required: true
      },
    },
    data() {
      return {
        notes: [],
        loading: true
      }
    },
    watch: {
      showModal: function () {
        this.loading = true;
        this.fetchNotes();
      }
    },
    created() {

      this.fetchNotes();

    },
    mounted() {

    },
    methods: {
      closeModal() {
        this.$emit('close');
      },

      fetchNotes() {
        getNotes(this.caseType, this.caseId)
            .then(({data}) => {
              this.notes = data.data;
              this.loading = false;
            }).catch(error => {
        });
      }
    },

  }
</script>

<style lang="scss">

</style>