<template>
    <div class="row">
        <div class="col-md-4">
            <panel
                    customClass=""
                    :hasTitle="hasTitle"
                    title="Sara Hourani">
                <div class="firm-id uppercase text-green text-left font-bold -mt-4 mb-4">
                    ID 56544156
                </div>
                <ul class="firm-info list-reset text-left pr-8">
                    <li class=" border-b border-grey-light py-3 pl-16  hd:text-lg xl:text-md text-black relative">
                        Restaurant
                        <i class="fas fa-store absolute pin-l pin-t text-grey-darkest text-2xl mt-3 ml-1"></i>
                    </li>
                    <li class=" border-b border-grey-light py-3 pl-16 hd:text-lg xl:text-md text-black relative">
                        Located in Amman
                        <i class="fas fa-map-marker-alt absolute pin-l pin-t text-grey-darkest text-2xl mt-3 ml-1 "></i>

                    </li>
                    <li class=" border-b border-grey-light py-3 pl-16 hd:text-lg xl:text-md text-black relative">
                        +123 456 789 234
                        <i class="fas fa-phone absolute pin-l pin-t text-grey-darkest text-2xl mt-3 ml-1 "></i>

                    </li>
                    <li class=" border-b border-grey-light py-3 pl-16 hd:text-lg xl:text-md text-black relative">
                        Looking for waiters
                        <i class="fas fa-briefcase absolute pin-l pin-t text-grey-darkest text-2xl mt-3 ml-1"></i>

                    </li>

                </ul>



                <div class="stared-note uppercase text-green text-left font-bold mt-4 mb-4">
                    Starred Note
                </div>
                <notebox
                        :showStar="showStar"
                        :showCreatorDetails="showStar"
                        custom-class="border-none p-0"
                ></notebox>
            </panel>
        </div>
        <div class="col-md-8">

            <panel
                    :has-title="hasTitle"
                    title="Job openings">
                <ul class="nav nav-tabs border-0 custom-navs mb-4">
                    <li class="">
                        <a data-toggle="tab" class="nav-link active border-0
                                            rounded-full
                                            text-grey-dark text-base font-semibold "
                           href="#current">Current</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" class="nav-link border-0
                                                text-grey-dark text-base font-semibold"
                           href="#matches">Matches</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="current" class="tab-pane fade in active show">
                        <jobOpening></jobOpening>
                        <jobOpening></jobOpening>
                    </div>

                    <div id="matches" class="tab-pane fade in">
                        <datatable
                                :hasPagination="filters"
                                :hasFilters="filters"
                        ></datatable>
                    </div>
                </div>

            </panel>

            <panel
                    :has-title="hasTitle"
                    title="Notes">
                <btn
                        @btn-click="btnClick"
                        :theme="'success'"
                        :btnClass="'mb-2 uppercase absolute pin-t pin-r mt-4 mr-4'">
                    <template slot="text">
                        Add note
                    </template>
                </btn>

                <notebox></notebox>
                <!--<notebox></notebox>-->
            </panel>


        </div>
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
    import jobOpening from '../components/jobOpening/jobOpening'
    import datatable from '../components/datatable/datatable'

    export default {
        components: {
            btn, AnchorLink,
            CustomSelect, modal, buttonGroup,
            checkbox, checkboxGroup, panel, metricCard,
            addNoteModal, notebox, jobOpening, datatable
        },
        props: {},
        data() {
            return {
                hasTitle: true,
                showStar:false,
                filters:false,
            }
        },
        created() {
        },
        computed: {},
        mounted() {

        },
        methods: {
            btnClick() {

            }
        },
        filters: {},
        watch: {}
    }
</script>