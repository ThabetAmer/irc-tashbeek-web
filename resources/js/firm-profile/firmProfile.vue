<template>
  <div class="flex">
    <div class="w-1/3 px-2">
      <Panel
        custom-class=""
        :has-title="hasTitle"
        title="Shams El Balad"
      >
        <div class="firm-id uppercase text-green text-left font-bold mt-4 mb-4">
          ID 56544156
        </div>
        <ul class="firm-info list-reset text-left pr-8 mb-4">
          <li class=" border-b border-grey-light py-5 flex items-center hd:text-md xl:text-md text-black ">
            <i class="fas fa-store   text-grey-darker text-xl min-w-30 mr-3 ml-1" />
            <span>Restaurant</span>
          </li>
          <li class=" border-b border-grey-light py-5 flex items-center hd:text-md xl:text-md text-black ">
            <i class="fas fa-map-marker-alt text-grey-darker text-xl min-w-30 mr-3 ml-1" />
            <span>Located in Amman</span>
          </li>
          <li class=" border-b border-grey-light py-5 flex items-center hd:text-md xl:text-md text-black ">
            <i class="fas fa-phone text-grey-darker text-xl min-w-30 mr-3 ml-1" />
            <span> +123 456 789 234</span>
          </li>
          <li class=" border-b border-grey-light py-5 flex items-center hd:text-md xl:text-md text-black ">
            <i class="fas fa-briefcase text-grey-darker text-xl min-w-30 mr-3 ml-1" />
            <span>Looking for waiters</span>
          </li>
        </ul>


        <div class="stared-note uppercase text-green text-left font-bold mt-6 -mb-2">
          Starred Note
        </div>
        <Notebox
          :show-star="showStar"
          :show-creator-details="showStar"
          custom-class="border-none pl-0 "
        />
      </Panel>
    </div>
    <div class="w-2/3 px-2">
      <Panel
        :has-title="hasTitle"
        title="Job openings"
      >
        <ul class="list-reset flex border-0 custom-navs mb-4">
          <li class="flex-inline mr-2">
            <button
              :class="{active:viewType =='current'}"
              class="nav-link border-0
                                 rounded-full py-2 px-4
                                 text-grey-dark text-base font-semibold "
              @click="changeViewType('current')"
            >
              Current
            </button>
          </li>
          <li class=" flex-inline mr-2">
            <button
              :class="{active:viewType =='matches'}"
              class="nav-link border-0 py-2 px-4
                                text-grey-dark text-base font-semibold"
              @click="changeViewType('matches')"
            >
              Matches
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <div
            v-if="viewType =='current'"
            id="current"
            class="tab-pane fade in active show"
          >
            <JobOpening />
            <JobOpening />
          </div>

          <div
            v-if="viewType =='matches'"
            id="matches"
            class="tab-pane fade in"
          >
            <Datatable
              :has-pagination="filters"
              :has-filters="filters"
            />
          </div>
        </div>
      </Panel>

      <Panel
        :has-title="hasTitle"
        title="Notes"
      >
        <Btn
          :theme="'success'"
          :btn-class="'mb-2 uppercase absolute pin-t pin-r mt-4 mr-4'"
          @btn-click="btnClick"
        >
          <template slot="text">
            Add note
          </template>
        </Btn>

        <Notebox />
        <!--<notebox></notebox>-->
      </Panel>
    </div>
  </div>
</template>


<script>
  import Btn from '../components/button/button'
  import AnchorLink from '../components/link/link'
  import CustomSelect from '../components/select/select'
  import Modal from '../components/modal/modal'
  import AddNoteModal from '../components/modal/addNoteModal'
  import ButtonGroup from '../components/buttonGroup/buttonGroup'
  import Checkbox from '../components/checkbox/checkbox'
  import CheckboxGroup from '../components/checkboxGroup/checkbox-group'
  import Panel from '../components/Panel/Panel'
  import MetricCard from '../components/MetricCard/MetricCard'
  import Notebox from '../components/notebox/notebox'
  import JobOpening from '../components/jobOpening/jobOpening'
  import Datatable from '../components/datatable/datatable'

  export default {
    components: {
      Btn, AnchorLink,
      CustomSelect, Modal, ButtonGroup,
      Checkbox, CheckboxGroup, Panel, MetricCard,
      AddNoteModal, Notebox, JobOpening, Datatable
    },
    filters: {},
    props: {},
    data() {
      return {
        viewType: 'current',
        hasTitle: true,
        showStar: false,
        filters: false,
      }
    },
    computed: {},
    watch: {},
    created() {
    },
    mounted() {

    },
    methods: {
      changeViewType(type) {
        this.viewType = type;
      },
      btnClick() {

      }
    }
  }
</script>