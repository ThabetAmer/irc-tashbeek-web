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
  import Panel from '../components/panel/panel'

  export default {
    components: {Panel, Datatable},
    filters: {},
    props: {},
    data() {
      return {
        hasFilter: true,
        hasPagination: true,
        rows: [
          {
            id: 1,
            name: 'Boutros Baqaeen',
            location: 'Ramallah',
            gender: 'Male',
            nationality: 'German',
            jobPreferences: 'Teacher',
            age:23


          },
          {
            id: 1,
            name: 'Boutros Baqaeen',
            location: 'Ramallah',
            gender: 'Male',
            nationality: 'German',
            jobPreferences: 'Teacher',
            age:23


          },
          {
            id: 1,
            name: 'Boutros Baqaeen',
            location: 'Ramallah',
            gender: 'Male',
            nationality: 'German',
            jobPreferences: 'Teacher',
            age:23


          },

        ],
        headers: [
          {
            name: 'id',
            translations:
                {
                  en: 'ID',
                  ar: 'id'
                }
          },
          {
            name: 'name',
            translations:
                {
                  en: 'Name',
                  ar: 'id'
                }
          },
          {
            name: 'location',
            translations:
                {
                  en: 'Location',
                  ar: 'id'
                }
          },
          {
            name: 'gender',
            translations:
                {
                  en: 'Gender',
                  ar: 'id'
                }
          },
          {
            name: 'nationality',
            translations:
                {
                  en: 'Nationality',
                  ar: 'id'
                }
          },
          {
            name: 'jobPreferences',
            translations:
                {
                  en: 'Job Preferences',
                  ar: 'id'
                }
          },
          {
            name: 'age',
            translations:
                {
                  en: 'Age',
                  ar: 'id'
                }
          },

        ]
      }
    },
    computed: {},
    watch: {},
    created() {
    },
    mounted() {

    },
    methods: {}
  }
</script>