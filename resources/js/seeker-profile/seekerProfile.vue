<template>
    <div class="row">
        <div class="col-md-4">
            <panel
                    customClass="minHeight900"
                    :hasTitle="hasTitle"
                    title="Shams El Balad">
                <div class="firm-id uppercase text-green text-left font-bold -mt-4 mb-4">
                    ID 456465456
                </div>

                <ul class="firm-info list-reset text-left pr-8">
                    <li class=" border-b border-grey-light py-3 pl-16  hd:text-lg xl:text-md text-black relative">
                        Syrian female • 25 years old
                        <i class="fas fa-store absolute pin-l pin-t text-grey-darkest text-2xl mt-3 ml-1"></i>
                    </li>
                    <li class=" border-b border-grey-light py-3 pl-16 hd:text-lg xl:text-md text-black relative">
                        Living in Irbid
                        <i class="fas fa-map-marker-alt absolute pin-l pin-t text-grey-darkest text-2xl mt-3 ml-1 "></i>

                    </li>
                    <li class=" border-b border-grey-light py-3 pl-16 hd:text-lg xl:text-md text-black relative">
                        Willing to work in QIZ
                        <i class="fas fa-map-pin absolute pin-l pin-t text-grey-darkest text-2xl mt-3 ml-1 "></i>

                    </li>
                    <li class=" border-b border-grey-light py-3 pl-16 hd:text-lg xl:text-md text-black relative">
                        +123 456 789 234
                        <i class="fas fa-phone absolute pin-l pin-t text-grey-darkest text-2xl mt-3 ml-1 "></i>

                    </li>
                    <li class=" border-b border-grey-light py-3 pl-16 hd:text-lg xl:text-md text-black relative">
                        Baking • Photoshop • Carpentry
                        <i class="fas fa-gem absolute pin-l pin-t text-grey-darkest text-2xl mt-3 ml-1"></i>

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
                    customClass="minHeight900"
                    :has-title="hasTitle"
                    title="Job openings">
                <ul class="nav nav-tabs border-0 custom-navs mb-4">
                    <li class="" @click="showAddNote = false">
                        <a data-toggle="tab" class="nav-link active border-0
                                            rounded-full
                                            text-grey-dark text-base font-semibold "
                           href="#all">All</a>
                    </li>
                    <li class="" @click="showAddNote = false">
                        <a data-toggle="tab" class="nav-link border-0
                                                text-grey-dark text-base font-semibold"
                           href="#screening">Screening</a>
                    </li>


                    <li class="" @click="showAddNote = false">
                        <a data-toggle="tab" class="nav-link border-0
                                                text-grey-dark text-base font-semibold"
                           href="#matched">Matched</a>
                    </li>

                    <li class="" @click="showAddNote = false">
                        <a data-toggle="tab" class="nav-link border-0
                                                text-grey-dark text-base font-semibold"
                           href="#candidate">Candidate</a>
                    </li>

                    <li class="" @click="showAddNote = true">
                        <a data-toggle="tab" class="nav-link border-0
                                                text-grey-dark text-base font-semibold"
                           href="#notes">Notes</a>
                    </li>
                    <li v-if="showAddNote" class="absolute mr-4 pin-r">
                        <btn
                                @btn-click="addNoteClick"
                                :theme="'success'"
                                :btnClass="'mb-2 text-sm fade in show'">
                            <template slot="text">
                                Add Note
                            </template>
                        </btn>
                    </li>


                </ul>
                <div class="tab-content">
                    <div id="all" class="tab-pane fade in active show">
                        <screenbox></screenbox>
                        <screenbox></screenbox>

                    </div>

                    <div id="screening" class="tab-pane fade in">
                        <screenbox></screenbox>
                    </div>

                    <div id="matched" class="tab-pane fade in">
                        <screenbox></screenbox>
                        <screenbox></screenbox>

                    </div>

                    <div id="candidate" class="tab-pane fade in">
                        <screenbox></screenbox>

                    </div>

                    <div id="notes" class="tab-pane fade in">
                        <notebox></notebox>
                        <notebox></notebox>
                    </div>
                </div>

            </panel>
        </div>

        <addNoteModal
                @close="closeModalNote"
                :show-modal="showAddModalNote"
        >

        </addNoteModal>



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

    export default {
        components: {
            btn, AnchorLink,
            CustomSelect, modal, buttonGroup,
            checkbox, checkboxGroup, panel, metricCard,
            addNoteModal, notebox, jobOpening, datatable,screenbox
        },
        props: {},
        data() {
            return {
                showFullNote:false,
                showAddNote: false,
                hasTitle: true,
                showStar: false,
                filters: false,
                showAddModalNote:false
            }
        },
        created() {
        },
        computed: {},
        mounted() {

        },
        methods: {
            addNoteClick() {
                this.showAddModalNote = true;
            },
            closeModalNote(){
                this.showAddModalNote = false;

            }
        },
        filters: {},
        watch: {}
    }
</script>