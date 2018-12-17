<template>
  <div>
    <Panel>
      <Datatable
        :header="headers"
        :rows="rows"
        :pagination="pagination"
        :filters="filters"
        :user-filters="userFilters"
        @filter="filterChange"
        @filterSelect="filterSelect"
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
        userFilters: [],
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
      this.loadData();
    },
    methods: {
      filterChange(event) {
        if(this.filterTimeout){
          clearTimeout(this.filterTimeout)
        }
        this.filterTimeout = setTimeout(() => {
          this.filters = this.filters.map(filter => {
            if (filter.name === event.name) {
              return {
                ...filter,
                filterValue: event.value
              }
            }
            return filter
          })
        },600)
      },
      filterSelect({name}) {
        const filterIndex = this.filters.findIndex(filter => filter.name === name)
        const userFilterIndex = this.userFilters.findIndex(filter => filter.name === name)

        if (userFilterIndex === -1) {
          this.userFilters.push({
            ...this.filters[filterIndex]
          })
        } else {
          this.userFilters.splice(userFilterIndex, 1)
        }
      },
      loadData(){
        return getListing(this.type)
          .then(({data}) => {
            this.rows = data.data;
            this.headers = data.headers;
            this.filters = data.filters;
            if (this.userFilters.length === 0) {
              this.userFilters = data.filters.slice(0, 3);
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
      }
    }
  }
</script>