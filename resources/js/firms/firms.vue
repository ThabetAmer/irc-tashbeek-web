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
  import btn from '../components/button/button'
  import AnchorLink from '../components/link/link'
  import CustomSelect from '../components/select/select'
  import modal from '../components/modal/modal'
  import addNoteModal from '../components/modal/addNoteModal'
  import buttonGroup from '../components/buttonGroup/buttonGroup'
  import checkbox from '../components/checkbox/checkbox'
  import checkboxGroup from '../components/checkboxGroup/checkbox-group'
  import Panel from '../components/Panel/Panel'
  import MetricCard from '../components/MetricCard/MetricCard'
  import notebox from '../components/notebox/notebox'
  import screenbox from '../components/screenbox/screenbox'
  import jobOpening from '../components/jobOpening/jobOpening'
  import datatable from '../components/datatable/datatable'
  // import addNoteModal from '../components/modal/addNoteModal'

  import firmsAPI from '../API/firms'

  export default {
    components: {
      btn, AnchorLink,
      CustomSelect, modal, buttonGroup,
      checkbox, checkboxGroup, Panel, MetricCard,
      addNoteModal, notebox, jobOpening, datatable, screenbox
    },
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