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
        @filterSelect="filterSelect"
      />
    </Panel>
  </div>
</template>

<script>
  import Datatable from '../components/datatable/datatable'
  import Panel from '../components/Panel/Panel'
  import {get as getListing} from '../API/caseListing'
  import FiltersProvider from "../mixins/FiltersProvider";
  import {queryStringToParams} from '../helpers/query-string'

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
      const queryStringObject = queryStringToParams();
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

        let queryString = this.makeQueryString(params);

        queryString = queryString !== '' ? '?' + queryString : '';

        const url = window.location.protocol + "//" + window.location.host + window.location.pathname + queryString;

        history.pushState({}, document.title, url);
      },
      makeQueryString(obj, prefix) {
        const str = [];
        for (let p in obj) {
          if (obj.hasOwnProperty(p)) {
            let k = prefix ? prefix + "[" + p + "]" : p;
            let v = obj[p];
            str.push((v !== null && typeof v === "object") ?
              this.makeQueryString(v, k) :
              encodeURIComponent(k) + "=" + encodeURIComponent(v));
          }
        }
        return str.filter(string => string && String(string) !== "" ).join("&");
      },
    }
  }
</script>