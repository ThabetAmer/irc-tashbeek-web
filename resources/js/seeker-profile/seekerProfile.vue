<template>
  <div class="flex">
    <div class="w-1/3 px-2">
      <Panel
        custom-class="min-h-900 "
        :has-title="hasTitle"
        :title="`${jobSeeker.first_name} ${jobSeeker.last_name}`"
      >
        <div class="firm-id uppercase text-green text-left font-bold mt-4 mb-4 flex items-center">
          ID
          <Clipboard
            :to-be-copied="jobSeeker.commcare_id"
          >
            <span
              slot="copyTemplate"
              class="truncate max-w-2xl pl-2"
            >
              {{ jobSeeker.commcare_id }}
            </span>
          </Clipboard>
        </div>
        <ul class="firm-info list-reset text-left pr-6">
          <ListItem
            icon="icon-User_Female_x40_2xpng_2"
          >
            <div slot="item-template">
              <span
                v-if="jobSeeker.nationality"
                class="mr-1"
              >
                {{ jobSeeker.nationality }}
              </span>
              <span
                v-if="jobSeeker.gender"
                class="mr-1"
              >
                {{ jobSeeker.gender }}
              </span>
              <span
                v-if="jobSeeker.age"
                class="mr-1"
              >
                • {{ jobSeeker.age }} years old
              </span>
            </div>
          </ListItem>

          <ListItem
            icon="icon-Location_Pin_1_1"
          >
            <span slot="item-template">
              Living in {{ jobSeeker.city }}<span v-if="jobSeeker.district !== ''">
                • {{ jobSeeker.district }}
              </span>
            </span>
          </ListItem>

          <ListItem
            v-if="jobSeeker.will_work_qiz === '1'"
            icon="icon-Location_Pin_3_1"
          >
            <span
              slot="item-template"
            >
              Willing to work in QIZ
            </span>
          </ListItem>

          <ListItem
            icon="icon-Phone_1_x40_2xpng_2"
          >
            <span
              slot="item-template"
            >
              {{ jobSeeker.mobile_num }}
            </span>
          </ListItem>

          <ListItem
            v-if="jobSeeker.first_preference || jobSeeker.second_preference"
            icon="icon-Diamond_x40_2xpng_2"
          >
            <div>
              <span v-if="jobSeeker.first_preference">
                {{ jobSeeker.first_preference }}
              </span>

              <span v-if="jobSeeker.first_preference && jobSeeker.second_preference">
                •
              </span>

              <span v-if="jobSeeker.second_preference">
                {{ jobSeeker.second_preference }}
              </span>
            </div>
          </ListItem>
        </ul>


        <div class="stared-note uppercase text-green text-left font-bold mt-10 mb-4">
          Starred Note
        </div>
        <Notebox
          :body="starredNote.body"
          :date="starredNote.date"
          :author="starredNote.author"
          :show-star="false"
          :show-creator-details="false"
          custom-class="border-none pl-0"
        />
      </Panel>
    </div>
    <div class="w-2/3 px-2">
      <Panel
        custom-class="min-h-900 max-h-900 overflow-y-auto"
        :has-title="hasTitle"
        title="Job openings"
      >
        <ul class="flex list-reset border-0 custom-navs mb-4">
          <li
            class="flex-inline mr-1"
            @click="changeJobOpeningview('all')"
          >
            <button
              :class="{active: jobOpeningView=='all'}"
              class="nav-link  border-0 py-2 px-4
                                 rounded-full  no-underline
                                 text-grey-dark text-sm font-semibold "
            >
              All
            </button>
          </li>
          <li
            class="flex-inline mr-1"
            @click="changeJobOpeningview('screening')"
          >
            <button
              :class="{active: jobOpeningView=='screening'}"
              class="nav-link border-0 no-underline py-2 px-4
                                                text-grey-dark text-sm font-semibold"
            >
              Screening
            </button>
          </li>


          <li
            class="flex-inline mr-1"
            @click="changeJobOpeningview('matched')"
          >
            <button
              :class="{active: jobOpeningView=='matched'}"
              class="nav-link border-0 no-underline  py-2 px-4
                                                text-grey-dark text-sm font-semibold"
            >
              Matched
            </button>
          </li>

          <li
            class="flex-inline mr-1"
            @click="changeJobOpeningview('candidate')"
          >
            <button
              :class="{active: jobOpeningView=='candidate'}"
              class="nav-link border-0 no-underline  py-2 px-4
                                                text-grey-dark text-sm font-semibold"
            >
              Candidate
            </button>
          </li>

          <li
            class="flex-inline mr-1"
            @click="changeJobOpeningview('notes')"
          >
            <button
              :class="{active: jobOpeningView=='notes'}"
              class="nav-link border-0 no-underline  py-2 px-4
                        text-grey-dark text-sm font-semibold"
            >
              Notes
            </button>
          </li>
          <li
            v-if="showAddNote"
            class="absolute mr-4 pin-r"
          >
            <Btn
              :theme="'success'"
              :btn-class="'mb-2 text-sm fade in show'"
              @btn-click="addNoteClick"
            >
              <template slot="text">
                Add Note
              </template>
            </Btn>
          </li>
        </ul>
        <div class="tab-content">
          <div
            v-if="jobOpeningView=='all'"
            class=""
          >
            <Screenbox />
            <Screenbox />
          </div>

          <div
            v-if="jobOpeningView=='screening'"
            class=""
          >
            <Screenbox />
          </div>

          <div
            v-if="jobOpeningView=='matched'"
            class=""
          >
            <Screenbox />
            <Screenbox />
          </div>

          <div
            v-if="jobOpeningView=='candidate'"
            class=""
          >
            <Screenbox />
          </div>

          <div
            v-if="jobOpeningView=='notes'"
            class=""
          >
            <Notebox

              v-for="note in notes"
              :id="note.id"
              :key="note.id"
              :date="note.date"
              :author="note.author"
              :body="note.body"
              @noteStarred="changeStarredNote"
            />
            <!--<notebox></notebox>-->
          </div>
        </div>
      </Panel>
    </div>

    <AddNoteModal
      :show-modal="showAddModalNote"
      @note-added="addNoteToList"
      @close="closeModalNote"
    />
  </div>
</template>


<script>
  import Btn from '../components/button/button'
  import AnchorLink from '../components/link/link'
  import CustomSelect from '../components/select/select'
  import Modal from '../components/modal/modal'
  import AddNoteModal from '../components/modal/addNoteModal'
  import buttonGroup from '../components/buttonGroup/buttonGroup'
  import Checkbox from '../components/checkbox/checkbox'
  import CheckboxGroup from '../components/checkboxGroup/checkbox-group'
  import Panel from '../components/panel/panel'
  import MetricCard from '../components/metricCard/metricCard'
  import Notebox from '../components/notebox/notebox'
  import Screenbox from '../components/screenbox/screenbox'
  import JobOpening from '../components/jobOpening/jobOpening'
  import Datatable from '../components/datatable/datatable'
  import Clipboard from '../components/clipboard/clipboard'
  import ListItem from '../components/listItem/listItem'
  // import addNoteModal from '../components/modal/addNoteModal'

  export default {
    components: {
      Btn, AnchorLink,Clipboard,ListItem,
      CustomSelect, Modal, buttonGroup,
      Checkbox, CheckboxGroup, Panel, MetricCard,
      AddNoteModal, Notebox, JobOpening, Datatable, Screenbox
    },
    props: {
      jobSeeker: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        jobOpeningView: 'all',
        showFullNote: false,
        showAddNote: false,
        hasTitle: true,
        showStar: false,
        filters: false,
        showAddModalNote: false,
        starredNote: {
          id: 1,
          date: 'Wednesday 12 November',
          author: 'Mohammad Karmi',
          body: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s\n' +
          '            standard dummy text ever since the 1500s, when an unknown printer\n' +
          '            took a galley of type and scrambled it to make a type specimen book.\n' +
          '            It has survived not only five centuries, but also the leap into electronic\n' +
          '            typesetting, remaining essentially unchanged',
        },
        notes: [
          {
            id: 1,
            date: 'Wednesday 12 November',
            author: 'Mohammad Karmi',
            body: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s\n' +
            '            It has survived not only five centuries, but also the leap into electronic\n' +
            '            typesetting, remaining essentially unchanged',

          },
          {
            id: 2,
            date: 'Wednesday 12 November',
            author: 'Mohammad Karmi',
            body: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s\n' +
            '            standard dummy text ever since the 1500s, when an unknown printer\n' +
            '            took a galley of type and scrambled it to make a type specimen book.\n' +
            '            It has survived not only five centuries, but also the leap into electronic\n' +
            '            typesetting, remaining essentially unchanged',

          }
        ]
      }
    },
    methods: {
      changeJobOpeningview(view) {
        console.log(' view is ', view);
        this.jobOpeningView = view;
        if (view == 'notes') {
          this.showAddNote = true;
        }
      },
      addNoteClick() {
        this.showAddModalNote = true;
      },
      closeModalNote() {
        this.showAddModalNote = false;

      },
      addNoteToList(noteText) {
        console.log(' added note is ', noteText);
        this.notes.push({
          id: 3,
          body: noteText,
          date: 'Wednesday 12 November',
          author: 'Mohammad Karmi'

        })
      },
      changeStarredNote(note) {
        this.starredNote = note;
      }
    },

  }
</script>