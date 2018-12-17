<template>
  <div>
    <Panel>
      <Datatable
        :header="headers"
        :rows="rows"
        :has-pagination="hasPagination"
        :has-filters="hasFilter"
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
        hasFilter: true,
        hasPagination: true,
        rows: [],
        headers: []
      }
    },
    computed: {},
    watch: {},
    mounted() {
      getListing(this.type)
        .then(resp => {
          this.rows = resp.data;
          this.headers = resp.headers;
          console.log(resp)
        }).catch(error => {
        console.log('Error : ', error);
      });
    },
    methods: {}
  }
</script>