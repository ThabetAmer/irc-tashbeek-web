<template>
  <div class="flex">
    <div class="w-1/3 pr-2">
      <Panel
        custom-class="min-h-642"
        :has-title="hasTitle"
        :title="firm.firm_name"
      >
        <div class="firm-id uppercase text-green text-left font-bold mt-4 mb-4 flex items-center">
          {{ 'irc.id' | trans }}
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
              {{ 'irc.located_in' | trans }}
              <a
                v-if="firm.city"
                class="link text-blue-dark font-bold"
                :href="`${homeUrl}/firms?filters[city]=${firm.city}`"
              >
                {{ firm.city }}
              </a>

              <span
                v-if="firm.city && firm.district"
                class="mx-1 link text-blue-dark font-bold"
              >
                •
              </span>

              <a
                v-if="firm.district"
                class="link text-blue-dark font-bold"
                :href="`${homeUrl}/firms?filters[district]=${firm.district}`"
              >
                {{ firm.district }}
              </a>
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
            v-if="jobOpenings.length > 0"
            icon="icon-Briefcase_x40_2xpng_2"
          >
            <span>
              {{ 'irc.looking_for' | trans }} {{ jobOpenings[jobOpenings.length - 1].job_title }}
            </span>
          </ListItem>
        </ul>


        <div class="stared-note uppercase text-green text-left font-bold mt-6 -mb-2">
          {{ 'irc.starred_note' | trans }}
        </div>

        <Notebox
          v-if="starredNote"
          :body="starredNote.note"
          :date="starredNote.date"
          :author="starredNote.author"
          :show-star="false"
          :show-creator-details="false"
          custom-class="border-none pl-0"
        />

        <EmptyState
          v-else
          icon="icon-Stars_x40_2xpng_2 text-5xl mt-3 block"
          :message="'irc.no_starred_note' | trans "
          custom-class="mt-5 min-h-200 text-lg"
        />
      </Panel>
    </div>
    <div class="w-2/3 px-2">
      <Panel
        :has-title="hasTitle"
        custom-class="max-h-600 overflow-y-auto"
        :title="'irc.job_openings' | trans"
      >
        <ul class="list-reset flex border-0 custom-navs mb-4">
          <li class="flex-inline mr-2">
            <button
              :class="{active:viewType === 'current'}"
              class="nav-link border-0
                                 rounded-full py-2 px-4
                                 text-grey-dark text-sm font-semibold "
              @click="changeViewType('current')"
            >
              {{ 'irc.current' | trans }}
            </button>
          </li>
          <li class=" flex-inline mr-2">
            <button
              :class="{active:viewType === 'matches'}"
              class="nav-link border-0 py-2 px-4
                                text-grey-dark text-sm font-semibold"
              @click="changeViewType('matches')"
            >
              {{ 'irc.matches' | trans }}
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <div
            v-if="viewType === 'current'"
            id="current"
            class="tab-pane fade in active show"
          >
            <div
              v-if="jobOpenings.length > 0"
            >
              <JobOpening
                v-for="jobOpening in jobOpenings"
                :key="jobOpening.id"
                :city="firm.city || firm.district"
                :job-opening="jobOpening"
              />
            </div>
            <PageLoader
              v-else-if="jobOpeningsLoading"
              :message="'irc.job_openings_loading' | trans"
            />
            <EmptyState
              v-else
              custom-class="min-h-200 text-lg"
            />
          </div>

          <div
            v-if="viewType === 'matches'"
            id="matches"
            class="tab-pane fade in"
          >
            <CaseListing
              key="matches"
              :end-point="matchedEndPoint"
              type="firm"
              :has-filters="false"
              :change-url="false"
            />
          </div>
        </div>
      </Panel>

      <Panel
        :has-title="hasTitle"
        :title="'irc.notes' | trans"
      >
        <Btn
          :theme="'success'"
          :btn-class="'mb-2 uppercase absolute pin-t pin-r mt-4 mr-4'"
          @click="showAddModalNote = true"
        >
          <template slot="text">
            {{ 'irc.add_note' | trans }}
          </template>
        </Btn>

        <div v-if="notes.length && !notesLoading">
          <Notebox
            v-for="note in notes"
            :id="note.id"
            :key="note.id"
            :date="note.created_at_text"
            :author="note.user.name"
            :body="note.note"
            @noteStarred="changeStarredNote"
          />
        </div>
        <div v-else-if="!notes.length && notesLoading">
          <PageLoader
            :message="'irc.notes_loading' | trans"
          />
        </div>
        <EmptyState
          v-else
          icon="icon-Note_x40_2xpng_2 text-3xl mt-3 block"
          :message="'irc.no_notes_available' | trans"
          custom-class="mt-5 min-h-200 text-lg"
        />
        <!--<notebox></notebox>-->
      </Panel>
    </div>

    <AddNoteModal
      :show-modal="showAddModalNote"
      @note-added="addNoteToList"
      @close="showAddModalNote = false;"
    />
  </div>
</template>


<script>
  import {get as getCaseListing} from '../API/caseListing'
  import {get as getNotes} from '../API/noteAPI'
  import {post as addNote} from '../API/noteAPI'
  import {setNoteStarred as starNote} from '../API/noteAPI'

  export default {
    props: {
      firm: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        notesLoading:true,
        showAddModalNote: false,
        viewType: 'current',
        hasTitle: true,
        showStar: false,
        filters: false,
        jobOpenings: [],
        matches: [],
        matchedEndPoint: '',
        jobOpeningsLoading: true,
        notes: [],
        starredNote: null
      }
    },
    mounted() {
      this.matchedEndPoint = `api/firms/${this.firm.id}/matches`;

      getCaseListing('job-opening', {
        filters: {
          firm_id: this.firm.id,
        },
        sorting: {
          column: 'date_opened',
          type: 'asc',
        },
        paginate: false,

      }).then(({data}) => {
        this.jobOpeningsLoading = false
        this.jobOpenings = data.data
      });

      getNotes('firm', this.firm.id)
          .then(({data}) => {
            this.notes = data.data;
            this.notesLoading = false;
            this.notes.forEach(note => {
              if (note.is_starred) {
                this.starredNote = note;
              }
            })
          }).catch(error => {
        console.log('Error : ', error);
      });

    },
    computed: {
        homeUrl: function () { return window.homeUrl; }
    },
    methods: {
      changeStarredNote(note) {
        starNote('firm', this.firm.id, note.id)
            .then(resp => {
              if (resp.data.note.is_starred) {
                this.starredNote = resp.data.note;
              }
              else {
                this.starredNote = null;

              }
              this.$toasted.show(resp.data.message, {
                icon: 'icon-Stars_x40_2xpng_2 mr-2'
              })
            })
            .catch(error => {
            });

      },
      addNoteToList(noteText,type) {
        addNote('firm', this.firm.id, {note: noteText,type:type})
            .then(resp => {
              this.notes.push(resp.data.note);
            }).catch(error => {
          console.log('Error : ', error);
        });


      },
      changeViewType(type) {
        this.viewType = type;
      },
      btnClick() {

      }
    }
  }
</script>