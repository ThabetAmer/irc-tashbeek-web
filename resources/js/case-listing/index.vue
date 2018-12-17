<template>
  <div>
    <Panel>
      <Datatable
        :header="headers"
        :rows="rows"
        :pagination="pagination"
        :filters="filters"
        @filter="filterChange"
      />
    </Panel>
  </div>
</template>


<script>
  import Datatable from '../components/datatable/datatable'
  import Panel from '../components/Panel/Panel'
  import {get as getListing} from '../API/caseListing'

  export default {
    components: {Panel, Datatable},
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
        filters: [],
        pagination: {
          total: 0,
          lastPage: 1,
          perPage: 15,
          currentPage: 1
        },
      }
    },
    computed: {},
    watch: {},
    mounted() {
      getListing(this.type)
        .then(resp => {
          this.rows = resp.data;
          this.headers = resp.headers;
          this.filters = resp.filters;
          this.pagination = {
            total: resp.meta.total,
            lastPage: resp.meta.last_page,
            perPage: resp.meta.per_page,
            currentPage: resp.meta.current_page
          };
        }).catch(error => {
        console.log('Error : ', error);
      });
    },
    methods: {
      filterChange(event) {
        this.filters = this.filters.map(filter => {
          if (filter.name === event.name) {
            return {
              ...filter,
              filterValue: event.value
            }
          }
          return filter
        })
      }
    }
  }
</script>