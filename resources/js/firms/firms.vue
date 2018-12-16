<template>
    <div>
        <panel>
            <datatable
                    :header="headers"
                    :rows="rows"
                    :has-pagination="hasPagination"
                    :has-filters="hasFilter"
            >

            </datatable>
        </panel>
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
    import panel from '../components/panel/panel'
    import metricCard from '../components/metricCard/metricCard'
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
            checkbox, checkboxGroup, panel, metricCard,
            addNoteModal, notebox, jobOpening, datatable, screenbox
        },
        props: {},
        data() {
            return {
                hasFilter: true,
                hasPagination: true,
                rows:[],
                headers:[]
            }
        },
        created() {
            firmsAPI.getFirms()
                .then(resp => {
                    console.log(' resp is ', resp);
                    this.rows = resp.data;
                    this.headers= resp.headers;

                }).catch(error => {
                console.log('Error : ', error);
            });
        },
        computed: {},
        mounted() {

        },
        methods: {},
        filters: {},
        watch: {}
    }
</script>