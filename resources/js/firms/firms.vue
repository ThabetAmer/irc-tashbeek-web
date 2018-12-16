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


  import firmsAPI from '../API/firms'

  export default {
    components: {Panel, Datatable},
    filters: {},
    props: {},
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
    created() {
      firmsAPI.getFirms()
          .then(resp => {
            console.log(' resp is ', resp);
            this.rows = resp.data;
            this.headers = resp.headers;

          }).catch(error => {
        console.log('Error : ', error);
      });
    },
    mounted() {

    },
    methods: {}
  }
</script>