<template>
  <div class="flex">
    <div class="w-1/3 px-2">
      <Panel
        custom-class="min-h-900 "
        :has-title="hasTitle"
        title="Sara Hourani"
      >
        <div class="firm-id uppercase text-green text-left font-bold mt-4 mb-4">
          ID 456465456
        </div>

        <ul class="firm-info list-reset text-left pr-8">
          <li class=" border-b border-grey-light py-5 pl-16  hd:text-md xl:text-md text-black relative">
            Syrian female • 25 years old
            <i class="fas fa-store absolute pin-l pin-t text-grey-darkest text-2xl mt-4 ml-1" />
          </li>
          <li class=" border-b border-grey-light py-5 pl-16 hd:text-md xl:text-md text-black relative">
            Living in Irbid
            <i class="fas fa-map-marker-alt absolute pin-l pin-t text-grey-darkest text-2xl mt-4 ml-1 " />
          </li>
          <li class=" border-b border-grey-light py-5 pl-16 hd:text-md xl:text-md text-black relative">
            Willing to work in QIZ
            <i class="fas fa-map-pin absolute pin-l pin-t text-grey-darkest text-2xl mt-4 ml-1 " />
          </li>
          <li class=" border-b border-grey-light py-5 pl-16 hd:text-md xl:text-md text-black relative">
            +123 456 789 234
            <i class="fas fa-phone absolute pin-l pin-t text-grey-darkest text-2xl mt-4 ml-1 " />
          </li>
          <li class=" border-b border-grey-light py-5 pl-16 hd:text-md xl:text-md text-black relative">
            Baking • Photoshop • Carpentry
            <i class="fas fa-gem absolute pin-l pin-t text-grey-darkest text-2xl mt-4 ml-1" />
          </li>
        </ul>


        <div class="stared-note uppercase text-green text-left font-bold mt-10 mb-4">
          Starred Note
        </div>
        <Notebox
          :body="starredNote.body"
          :date="starredNote.date"
          :author="starredNote.author"
          :show-star="showStar"
          :show-creator-details="showStar"
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
            class="flex-inline mr-2"
            @click="changeJobOpeningview('all')"
          >
            <button
              :class="{active: jobOpeningView=='all'}"
              class="nav-link  border-0 py-2 px-4
                                 rounded-full  no-underline
                                 text-grey-dark text-base font-semibold "
            >
              All
            </button>
          </li>
          <li
            class="flex-inline mr-2"
            @click="changeJobOpeningview('screening')"
          >
            <button
              :class="{active: jobOpeningView=='screening'}"
              class="nav-link border-0 no-underline py-2 px-4
                                                text-grey-dark text-base font-semibold"
            >
              Screening
            </button>
          </li>


          <li
            class="flex-inline mr-2"
            @click="changeJobOpeningview('matched')"
          >
            <button
              :class="{active: jobOpeningView=='matched'}"
              class="nav-link border-0 no-underline  py-2 px-4
                                                text-grey-dark text-base font-semibold"
            >
              Matched
            </button>
          </li>

          <li
            class="flex-inline mr-2"
            @click="changeJobOpeningview('candidate')"
          >
            <button
              :class="{active: jobOpeningView=='candidate'}"
              class="nav-link border-0 no-underline  py-2 px-4
                                                text-grey-dark text-base font-semibold"
            >
              Candidate
            </button>
          </li>

          <li
            class="flex-inline mr-2"
            @click="changeJobOpeningview('notes')"
          >
            <button
              :class="{active: jobOpeningView=='notes'}"
              class="nav-link border-0 no-underline  py-2 px-4
                        text-grey-dark text-base font-semibold"
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
      addNoteModal, notebox, jobOpening, datatable, screenbox
    },
    props: {},
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