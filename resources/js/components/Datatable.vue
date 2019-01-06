<template>
  <div class="">
    <div
      v-if="rows.length > 0"
      class="table-container-main overflow-auto pl-2 mb-2"
    >
      <table :class="[`main-table w-full text-left`,{'table-striped' : striped,'scrollable-fixed-header' : fixedHeader} ,'mb-8']">
        <thead>
          <tr class="font-bold text-green-theme">
            <th
              v-for="head in header"
              :key="head.name"
              class="pb-2 pl-6 text-xs max-w-150 relative cursor-pointer"
              @click="$emit('sort',head.name)"
            >
              <span
                v-if="head['translations']['en'].length > 14"
                v-tooltip="{placement:'left',content:head['translations']['en'],classes:['tooltip-datatable']}"
                class=" truncate block"
              >
                {{ head['translations']['en'] }}
              </span>
              <span
                v-else
                class="truncate"
              >
                {{ head['translations']['en'] }}
              </span>

              <i
                :class="`icon-Down_Arrow_4_1 absolute pin-l pin-t ml-2
                ${sorting.column != head.name ? 'hidden':''}
                ${sorting.column === head.name && sorting.type === 'asc' ? 'icon-Up_Arrow_4_1' :'icon-Down_Arrow_4_1'}`"
              />
            </th>
            <th class="pb-2 px-4 pl-1 max-w-150 truncate" />
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="row in rows"
            :key="row.id"
            class="font-bold text-black  border-grey-light border-b-2"
          >
            <td
              v-for="head in header"
              :key="head.name"
              class="py-4 pl-6 text-sm"
            >
              <Component
                :is="row[head.name].component"
                v-if="row[head.name]&& row[head.name].component"
                :icon-class="row[head.name].component.iconClass"
                :text="row[head.name].component.text"
              />
              <span
                v-else-if="head.clickable_from && row[head.clickable_from]"
                class="py-1 max-w-150 truncate block"
                dir="auto"
              >
                <a
                  :href="row[head.clickable_from]"
                  class="text-blue-dark no-underline hover:underline "
                >
                  {{ row[head.name] }}
                </a>
              </span>
              <span
                v-else-if="row[head.name] && row[head.name].length > 10"
                v-tooltip="{placement: 'left',content:row[head.name],classes:['tooltip-datatable']}"
                class="max-w-150 truncate block"
                dir="auto"
              >
                {{ row[head.name] }}
              </span>
              <span
                v-else
                dir="auto"
              >
                {{ row[head.name] }}
              </span>
            </td>
            <td class="py-4 px-4 pl-2">
              <button
                class="flex-1 text-xl  text-green-dark"
                @click="viewNotes(row.id)"
              >
                <i class="icon-Page_1_x40_2xpng_2" />
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <EmptyState
      v-else
      custom-class="min-h-200 text-lg"
    />
    <Pagination
      v-if="pagination.lastPage > 1"
      :total-pages="pagination.lastPage"
      :total="pagination.total"
      :per-page="pagination.perPage"
      :current-page="pagination.currentPage"
      @pagechanged="$emit('pagechanged', $event)"
      @perPage="$emit('perPage', $event)"
    />

    <ViewNoteModal
      :show-modal="showNotesModal"
      :case-type="caseType"
      :case-id="caseId"
      @close="closeModalNote"
    />
  </div>
</template>


<script>

  import ViewNoteModal from './ViewNotesModal'
  export default {
    /**
     * all props have their needed types
     * and are passed using the mixin
     */
    components:{ViewNoteModal},
    props: {
      caseType:{
        type: String,
        required: true
      },
      loading:{
        type: Boolean,
        default:false
      },
      fixedHeader: {
        type: Boolean,
        default: false
      },
      pagination: {
        type: Object,
        default: () => ({
          lastPage: 1,
          perPage: 15,
          total: 0,
          currentPage: 1
        })
      },
      sorting:{
        type:Object,
        default: () => ({
        })
      },
      striped: {
        type: Boolean,
        default: true
      },
      header: {
        type: Array,
        default: () => []
      },
      rows: {
        type: Array,
        default: () => []
      }
    },
    data(){
      return{
        caseId:0,
        showNotesModal: false,
      }
    },
    methods:{
      viewNotes(caseId){
        this.showNotesModal = true;
        this.caseId = caseId;
      },
      closeModalNote(){
        this.showNotesModal = false;

      }
    }
  }
</script>

<style lang="scss">

</style>