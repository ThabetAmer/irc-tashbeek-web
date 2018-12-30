<template>
  <div>
    <Panel
      custom-class=""
    >
      <Filters
        v-if="filters.length > 0"
        :filters="filters"
        :user-filters="userFilters"
        @change="filterChange($event, loadData)"
        @filterSelect="filterSelect($event, loadData)"
      />
      <Datatable
        v-if="!loading"
        :header="headers"
        :rows="rows"
        :pagination="pagination"
        :sorting="sorting"
        @pagechanged="loadData({page: $event})"
        @sort="handleSort($event, loadData)"
      />
      <PageLoader v-else />
    </Panel>
  </div>
</template>

<script>
  import {get as getListing} from '../API/caseListing'
  import FiltersProvider from "../mixins/FiltersProvider";
  import queryString from '../helpers/query-string'
  import sortingProvider from "../mixins/sortingProvider";

  export default {
    mixins: [FiltersProvider, sortingProvider],
    props: {
      type: {
        type: String,
        required: true
      },
    },
    data() {
      return {
        loading: false,
        rows: [],
        headers: [],
        pagination: {
          total: 0,
          lastPage: 1,
          perPage: 15,
          currentPage: 1
        },
      }
    },
    mounted() {
      const queryStringObject = queryString.parse();
      this.loadData({
        page: queryStringObject.page,
        filters: queryStringObject.filters,
        sorting: queryStringObject.sorting
      });
    },
    methods: {
      loadData({filters = {}, page = null, sorting = {}} = {}) {
        filters = filters && typeof filters === "object" ? filters : {}
        sorting = sorting && typeof sorting === "object" ? sorting : {}
        const params = {
          filters: {
            ...filters,
            ...this.userFiltersToParams()
          },
          page: !isNaN(parseInt(page, 10)) ? page : this.pagination.currentPage,
          sorting: {
            ...this.sorting,
            ...sorting,
          }
        }
        this.loading = true
        return getListing(this.type, params)
          .then(({data}) => {
            this.changeUrlUsingParams(params);
            this.rows = data.data;
            this.headers = data.headers;
            this.filters = data.filters;
            this.sorting = data.sorting;
            if (this.userFilters.length === 0) {
              this.userFilters = this.initialUserFilters(data.filters.slice(0, 3), filters);
            }
            this.pagination = {
              total: data.meta.total,
              lastPage: data.meta.last_page,
              perPage: data.meta.per_page,
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
    }
  }
</script>