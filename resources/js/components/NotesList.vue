<template>
  <div>
    <EmptyState
      v-if="notes.length === 0 && !loading"
      icon="icon-Note_x40_2xpng_2 text-3xl mt-3 block"
      message="You don't have any notes!"
      custom-class="mt-5 min-h-200 text-lg"
    />
    <PageLoader
      v-else-if="loading"
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

      <div
        v-if="notes.length > 0"
        class=" text-xs my-3 pl-2"
      >
        Viewing {{ notes.length }} out of {{ pagination.total }}
      </div>

      <Pagination
        v-if="pagination.lastPage > 1"
        :total-pages="pagination.lastPage"
        :total="pagination.total"
        :per-page="pagination.perPage"
        :current-page="pagination.currentPage"
        :per-page-enabled="false"
        @pagechanged="fetchNotes({page:$event})"
      />
    </div>
  </div>
</template>

<script>
  import {get as getNotes} from '../API/noteAPI'
  import PaginationMixin from '../mixins/paginationMixin'
  export default {
    name: "NotesList",
    mixins: [PaginationMixin],
    /**
     * all props have their needed types
     * and are passed using the mixin
     */
    props: {
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
    created() {
      this.fetchNotes();
    },
    methods: {
      fetchNotes(params = {}) {
        this.loading = true;
        getNotes(this.caseType, this.caseId, params)
          .then(({data}) => {

            this.notes = data.data;

            this.setPaginationFromMeta(data.meta)

            this.loading = false;
          })
      }
    },
  }
</script>

<style scoped>

</style>