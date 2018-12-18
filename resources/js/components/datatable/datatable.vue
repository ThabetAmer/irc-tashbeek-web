<template>
  <div class="">
    <Filters
      v-if="filters.length > 0"
      :filters="filters"
      :user-filters="userFilters"
      @change="$emit('filter',$event)"
      @filterSelect="$emit('filterSelect',$event)"
    />
    <table :class="[`w-full text-left`,{'table-striped' : striped,'scrollable-fixed-header' : fixedHeader} ,'mb-8']">
      <thead>
        <tr class="font-bold text-green-dark">
          <th
            v-for="head in header"
            :key="head.name"
            class="pb-2 pl-1 text-xs max-w-100 truncate"
          >
            <span
              v-if="head['translations']['en'].length > 14"
              v-tooltip="{content:head['translations']['en'],classes:['tooltip-datatable']}"
            >
              {{ head['translations']['en'] }}
            </span>
            <span v-else>
              {{ head['translations']['en'] }}
            </span>
          </th>
          <th class="pb-2 px-4 pl-1 max-w-100 truncate" />
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
            class="py-4 pl-2 text-sm"
          >
            <Component
              :is="row[head.name].component"
              v-if="row[head.name]&& row[head.name].component"
              :icon-class="row[head.name].component.iconClass"
              :text="row[head.name].component.text"
            />
            <span v-else>
              {{ row[head.name] }}
            </span>
          </td>
          <td class="py-4 px-4 pl-2">
            <button class="flex-1 text-xl  text-green-dark">
              <i class="icon-Page_1_x40_2xpng_2" />
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <Pagination
      v-if="pagination.lastPage > 1"
      :total-pages="pagination.lastPage"
      :total="pagination.total"
      :per-page="pagination.perPage"
      :current-page="pagination.currentPage"
      @pagechanged="$emit('pagechanged', $event)"
    />
  </div>
</template>


<script>
  import Filters from './filters';
  import Pagination from './pagination';
  import HasFilters from "../../mixins/HasFilters";
  import Popper from 'vue-popperjs';
  import VTooltip from 'v-tooltip'

  export default {
    /**
     * all props have their needed types
     * and are passed using the mixin
     */
    components: {Filters, Pagination,Popper},
    filters: {},
    mixins: [HasFilters],
    props: {
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
  }
</script>

<style lang="scss">

</style>