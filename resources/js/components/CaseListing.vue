<template>
  <div>
    <Panel
      custom-class=""
    >
      <slot name="header" />

      <Filters
        v-if="filters.length > 0 && hasFilters"
        :filters="filters"
        :user-filters="userFilters"
        @change="filterChange($event, loadData)"
        @filterSelect="filterSelect($event, loadData)"
      />
      <Datatable
        v-if="!loading"
        :header="headers"
        :case-type="type"
        :rows="rows"
        :pagination="pagination"
        :sorting="sorting"
        @pagechanged="loadData({page: $event})"
        @perPage="loadData({perPage: $event})"
        @sort="handleSort($event, loadData)"
      >
        <template
          v-if="$scopedSlots['start-td']"
          slot="head-start-td"
        >
          <td class="pb-2 text-xs max-w-150 relative cursor-pointer">
            <slot
              name="head-start-td"
            />
          </td>
        </template>

        <template
          v-if="$scopedSlots['start-td']"
          slot="start-td"
          slot-scope="{row}"
        >
          <td class="pl-2">
            <slot
              :row="row"
              name="start-td"
            />
          </td>
        </template>

        <template
          v-if="$scopedSlots['end-td']"
          slot="end-td"
          slot-scope="{row}"
        >
          <td>
            <slot
              :row="row"
              name="end-td"
            />
          </td>
        </template>

        <td
          slot="extra"
          slot-scope="{row}"
          class="mr-2 pr-2"
        >
          <button
            class="flex-1 text-xl  text-green-dark"
            @click="viewNotes(row.id)"
          >
            <i class="icon-Page_1_x40_2xpng_2" />
          </button>
        </td>
      </Datatable>

      <PageLoader v-else />
    </Panel>

    <ViewNoteModal
      v-if="caseId"
      :show-modal="showNotesModal"
      :case-type="type"
      :case-id="caseId"
      @close="closeModalNote"
    />
  </div>
</template>

<script>
  import {get as getListing, getByUrl as getListingByUrl} from '../API/caseListing'
  import FiltersProvider from "../mixins/FiltersProvider";
  import queryString from '../helpers/QueryString'
  import sortingProvider from "../mixins/sortingProvider";
  import paginationMixin from "../mixins/paginationMixin";

  export default {
    mixins: [FiltersProvider, sortingProvider,paginationMixin],
    props: {
      type: {
        type: String,
        required: true
      },
      endPoint: {
        type: String,
        default: ""
      },
      changeUrl: {
        type: Boolean,
        default: true
      },
      hasFilters: {
        type: Boolean,
        default: true
      }
    },
    data() {
      return {
        caseId: 0,
        showNotesModal: false,
        loading: false,
        rows: [],
        headers: [],
      }
    },
    mounted() {
      const queryStringObject = queryString.parse();
      this.loadData({
        page: queryStringObject.page,
        filters: queryStringObject.filters,
        sorting: queryStringObject.sorting,
        perPage: queryStringObject.perPage
      });
    },
    methods: {
      loadData({filters = {}, page = null, sorting = {}, perPage = 15} = {}) {
        filters = filters && typeof filters === "object" ? filters : {}
        sorting = sorting && typeof sorting === "object" ? sorting : {}
        const params = {
          filters: {
            ...filters,
            ...this.userFiltersToParams()
          },
          page: !isNaN(parseInt(page, 10)) ? page : this.pagination.currentPage,
          perPage: !isNaN(parseInt(perPage, 15)) ? perPage : this.pagination.perPage,
          sorting: {
            ...this.sorting,
            ...sorting,
          }
        };
        this.loading = true

        let apiResponse;

        if (this.endPoint.trim() !== "") {
          apiResponse = getListingByUrl(this.endPoint, params)
        } else {
          apiResponse = getListing(this.type, params)
        }

        return apiResponse.then(({data}) => {
          if(this.changeUrl){
            this.changeUrlUsingParams(params);
          }
          this.rows = data.data;
          this.$emit('fetch', {
            data: data.data
          })
          this.headers = data.headers;
          this.filters = data.filters;
          this.sorting = data.sorting;
          if (this.userFilters.length === 0) {
            this.userFilters = this.initialUserFilters(data.filters.slice(0, 3), filters);
          }
          this.pagination = {
            total: data.meta.total,
            lastPage: data.meta.last_page,
            perPage: parseInt(data.meta.per_page),
            currentPage: data.meta.current_page
          };
          this.loading = false;
        }).catch(error => {
          console.log('Error : ', error);
        });
      },
      changeUrlUsingParams(params) {

        let serializedQueryString = queryString.serialize(params);

        serializedQueryString = serializedQueryString !== '' ? '?' + serializedQueryString : '';

        const url = window.location.protocol + "//" + window.location.host + window.location.pathname + serializedQueryString;

        history.pushState({}, document.title, url);
      },

      viewNotes(caseId) {
        this.showNotesModal = true;
        this.caseId = caseId;
      },
      closeModalNote() {
        this.showNotesModal = false;

      }
    }
  }
</script>