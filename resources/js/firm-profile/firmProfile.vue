<template>
  <div class="flex">
    <div class="w-1/3 px-2">
      <Panel
        custom-class=""
        :has-title="hasTitle"
        :title="firm.firm_name"
      >
        <div class="firm-id uppercase text-green text-left font-bold mt-4 mb-4 flex items-center">
          ID
          <Clipboard
            :to-be-copied="firm.commcare_id"
          >
            <span
              slot="copyTemplate"
              class="truncate max-w-2xl pl-2"
            >
              {{ firm.commcare_id }}
            </span>
          </Clipboard>
        </div>
        <ul class="firm-info list-reset text-left pr-8 mb-4">
          <ListItem
            v-if="firm.sector"
            icon="icon-Storefront_x40_2xpng_2"
          >
            <span>
              {{ firm.sector }}
            </span>
          </ListItem>

          <ListItem
            v-if="firm.city || firm.district"
            icon="icon-Location_Pin_1_1"
          >
            <span>
              Located in

                      <span
                        v-if="firm.city && firm.district"
                        class="mx-1"
                      >
                        •
                      </span>

                      <span>
                        {{ firm.district }}
                      </span>
            </span>
          </ListItem>

          <ListItem
            v-if="firm.contact_mobile"
            icon="icon-Phone_1_x40_2xpng_2"
          >
            <span>
              {{ firm.contact_mobile }}
            </span>
          </ListItem>

          <ListItem
            icon="icon-Briefcase_x40_2xpng_2"
          >
            <span>
              Implement once openings linked
            </span>
          </ListItem>
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
  import Panel from '../components/panel/panel'
  import MetricCard from '../components/metricCard/metricCard'
  import Notebox from '../components/notebox/notebox'
  import JobOpening from '../components/jobOpening/jobOpening'
  import Datatable from '../components/datatable/datatable'
  import Clipboard from '../components/clipboard/clipboard'
  import ListItem from '../components/listItem/listItem'

  export default {
    components: {
      Btn, AnchorLink, Clipboard, ListItem,
      CustomSelect, Modal, ButtonGroup,
      Checkbox, CheckboxGroup, Panel, MetricCard,
      AddNoteModal, Notebox, JobOpening, Datatable
    },
    filters: {},
    props: {
      firm: {
        type: Object,
        required: true
      }
    },
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