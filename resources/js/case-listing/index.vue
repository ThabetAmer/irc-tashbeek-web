<template>
  <div>
    <Panel
      custom-class="overflow-auto"
    >
      <Datatable
        :header="headers"
        :rows="rows"
        :pagination="pagination"
        :filters="filters"
        :user-filters="userFilters"
        @pagechanged="loadData({page: $event})"
        @filter="filterChange($event, loadData)"
        @filterSelect="filterSelect($event, loadData)"
      />
    </Panel>
  </div>
</template>

<script>
  import Datatable from '../components/datatable/datatable'
  import Panel from '../components/panel/panel'
  import {get as getListing} from '../API/caseListing'
  import FiltersProvider from "../mixins/FiltersProvider";
  import queryString from '../helpers/query-string'

  export default {
    components: {Panel, Datatable},
    mixins: [FiltersProvider],
    props: {
      type: {
        type: String,
        required: true
      }
    },
    data() {
      return {
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
      });
    },
    methods: {
      loadData({filters = {}, page = null} = {}) {
        filters = filters && typeof filters === "object" ? filters : {}
        const params = {
          filters: {
            ...filters,
            ...this.userFiltersToParams()
          },
          page: !isNaN(parseInt(page, 10)) ? page : this.pagination.currentPage
        }
        return getListing(this.type, params)
          .then(({data}) => {

            this.changeUrlUsingParams(params);

            this.rows = data.data;
            this.headers = data.headers;
            this.filters = data.filters;
            if (this.userFilters.length === 0) {
              this.userFilters = this.initialUserFilters(data.filters.slice(0, 3), filters);
            }
            this.pagination = {
              total: data.meta.total,
              lastPage: data.meta.last_page,
              perPage: data.meta.per_page,
              currentPage: data.meta.current_page
            };
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