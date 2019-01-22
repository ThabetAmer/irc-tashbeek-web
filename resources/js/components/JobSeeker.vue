<template>
  <div class="flex flex-wrap">
    <div class="w-full lg:w-1/3 lg:pr-2">
      <Panel
        custom-class="min-h-900 "
        :has-title="hasTitle"
        :title="`${jobSeeker.first_name} ${jobSeeker.last_name}`"
      >
        <div class="firm-id uppercase text-green text-left font-bold mt-4 mb-4 flex items-center">
          {{ 'irc.id' | trans }}
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
            v-if="jobSeeker.age || jobSeeker.nationality || jobSeeker.gender"
            icon="icon-User_Female_x40_2xpng_2"
          >
            <div>
              <span
                v-if="jobSeeker.nationality"
                class="mr-1"
              >
                {{ jobSeeker.nationality }}
              </span>
              <span
                v-if="jobSeeker.nationality && jobSeeker.gender"
                class="mx-1"
              >
                •
              </span>

              <span
                v-if="jobSeeker.gender"
                class="mr-1"
              >
                {{ jobSeeker.gender }}
              </span>

              <span
                v-if="jobSeeker.gender && jobSeeker.age"
                class="mx-1"
              >
                •
              </span>

              <span
                v-if="jobSeeker.age"
                class="mr-1"
              >
                {{ jobSeeker.age }} {{ 'irc.years_old' | trans }}
              </span>
            </div>
          </ListItem>

          <ListItem
            icon="icon-Location_Pin_1_1"
          >
            <span>
              {{ 'irc.living_in' | trans }} {{ jobSeeker.city }}

              <span
                v-if="jobSeeker.city && jobSeeker.district "
                class="mx-1"
              >
                •
              </span>

              <span v-if="jobSeeker.district !== ''">
                {{ jobSeeker.district }}
              </span>
            </span>
          </ListItem>

          <ListItem
            v-if="jobSeeker.will_work_qiz === '1'"
            icon="icon-Location_Pin_3_1"
          >
            <span>
              {{ 'irc.will_work_qiz' | trans }}
            </span>
          </ListItem>

          <ListItem
            icon="icon-Phone_1_x40_2xpng_2"
          >
            {{ jobSeeker.mobile_num }}
          </ListItem>

          <ListItem
            v-if="jobSeeker.first_preference || jobSeeker.second_preference"
            icon="icon-Diamond_x40_2xpng_2"
          >
            <div>
              <span v-if="jobSeeker.first_preference">
                {{ jobSeeker.first_preference }}
              </span>

              <span
                v-if="jobSeeker.first_preference && jobSeeker.second_preference"
                class="mx-1"
              >
                •
              </span>

              <span v-if="jobSeeker.second_preference">
                {{ jobSeeker.second_preference }}
              </span>
            </div>
          </ListItem>
        </ul>

        <div class="stared-note uppercase text-green text-left font-bold mt-10 -mb-2">
          {{ 'irc.starred_note' | trans }}
        </div>

        <Notebox
          v-if="starredNote"
          :body="starredNote.note"
          :date="starredNote.created_at_text"
          :author="starredNote.user.name"
          :show-star="false"
          :show-creator-details="false"
          custom-class="border-none pl-0"
        />
        <EmptyState
          v-else
          icon="icon-Stars_x40_2xpng_2 text-5xl mt-3 block"
          :message="'irc.no_starred_note' | trans"
          custom-class="mt-5 min-h-200 text-lg"
        />
      </Panel>
    </div>
    <div class="w-full lg:w-2/3 lg:px-2">
      <Panel
        custom-class="min-h-900 max-h-900 overflow-y-auto "
        :has-title="hasTitle"
        :title="'irc.recent_activity' | trans"
      >
        <ul class="flex list-reset border-0 custom-navs mb-4">
          <li
            class="flex-inline"
            @click="changeJobOpeningview('screening')"
          >
            <button
              :class="{active: jobOpeningView === 'screening'}"
              class="nav-link border-0 no-underline py-2 px-2 lg:py-2 lg:px-4
                                                text-grey-dark text-xs lg:text-sm font-semibold"
            >
              {{ 'irc.screening' | trans }}
            </button>
          </li>


          <li
            class="flex-inline"
            @click="changeJobOpeningview('matched')"
          >
            <button
              :class="{active: jobOpeningView === 'matched'}"
              class="nav-link border-0 no-underline py-2 px-2 lg:py-2 lg:px-4
                                                text-grey-dark text-xs lg:text-sm font-semibold"
            >
              {{ 'irc.matched' | trans }}
            </button>
          </li>

          <li
            class="flex-inline "
            @click="changeJobOpeningview('candidate')"
          >
            <button
              :class="{active: jobOpeningView === 'candidate'}"
              class="nav-link border-0 no-underline py-2 px-2 lg:py-2 lg:px-4
                                                text-grey-dark text-xs lg:text-sm font-semibold"
            >
              {{ 'irc.candidates' | trans }}
            </button>
          </li>

          <li
            class="flex-inline"
            @click="changeJobOpeningview('notes')"
          >
            <button
              :class="{active: jobOpeningView === 'notes'}"
              class="nav-link border-0 no-underline py-2 px-2 lg:py-2 lg:px-4
                                                text-grey-dark text-xs lg:text-sm font-semibold"
            >
              {{ 'irc.notes' | trans }}
            </button>
          </li>
        </ul>

        <Btn
          v-if="showAddNote"
          :theme="'success'"
          :btn-class="'mb-2 text-sm  absolute mr-4 mt-4 pin-t pin-r'"
          @click="addNoteClick"
        >
          <template slot="text">
            {{ 'irc.add_note' | trans }}
          </template>
        </Btn>
        <div class="tab-content">
          <div
            v-if="jobOpeningView === 'screening'"
            class=""
          >
            <div v-if="screening.length > 0">
              <Screenbox
                v-for="screen in screening"
                :key="screen.id"
                :screen="screen"
              />
            </div>
            <EmptyState
              v-else
              :message="'irc.no_screening' | trans"
              custom-class="mt-5 min-h-200 text-lg"
            />
          </div>

          <div
            v-if="jobOpeningView === 'matched'"
            class=""
          >
            <CaseListing
              key="matches"
              :end-point="matchedEndPoint"
              type="job-seeker"
              :has-filters="false"
              :change-url="false"
            />
          </div>

          <div
            v-if="jobOpeningView === 'candidate'"
            class=""
          >
            <CaseListing
              key="candidates"
              :end-point="candidateEndPoint"
              type="job-seeker"
              :has-filters="false"
              :change-url="false"
            />
          </div>

          <div
            v-if="jobOpeningView === 'notes'"
            class=""
          >
            <NotesList
              case-type="job-seeker"
              :case-id="jobSeeker.id"
            />
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
  import {get as getNotes} from '../API/noteAPI'
  import {get as getScreening} from '../API/screeningAPI'
  import {post as addNote} from '../API/noteAPI'
  import {setNoteStarred as starNote} from '../API/noteAPI'

  export default {
    props: {
      jobSeeker: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        jobOpeningView: 'screening',
        showFullNote: false,
        showAddNote: false,
        hasTitle: true,
        showStar: false,
        filters: false,
        showAddModalNote: false,
        starredNote: null,
        notes: [],
        matches: [],
        screening: [],
        matchedEndPoint: '',
        candidateEndPoint: ''
      }
    },
    created() {
      this.matchedEndPoint = `api/job-seekers/${this.jobSeeker.id}/matches`;
      this.candidateEndPoint = `api/job-seekers/${this.jobSeeker.id}/candidates`;
      this.getNotes();
      this.getScreening();
    },
    methods: {
      getScreening() {
        getScreening(this.jobSeeker.id)
            .then(({data})=> {
              // console.log(' screening is ', resp)
              this.screening=data.data;
            })
            .catch(error => {
              console.log(' error! ',error)
            });
      },
      getNotes() {
        getNotes('job-seeker', this.jobSeeker.id)
            .then(({data}) => {
              this.notes = data.data;
              this.notes.forEach(note => {
                if (note.is_starred) {
                  this.starredNote = note;
                }
              })
            }).catch(error => {
          console.log('Error : ', error);
        });
      },
      changeJobOpeningview(view) {
        this.$forceUpdate();
        this.jobOpeningView = view;
        if (view === 'notes') {
          this.showAddNote = true;
        } else {
          this.showAddNote = false;
        }
      },
      addNoteClick() {
        this.showAddModalNote = true;
      },
      closeModalNote() {
        this.showAddModalNote = false;

      },
      addNoteToList(noteText, type) {

        addNote('job-seeker', this.jobSeeker.id, {note: noteText, type: type ? type.name : ''})
            .then(resp => {
              this.notes.push(resp.data.note);
            })
            .catch(error => {
              this.$toasted.show(error.response.data.errors.note[0], {
                icon: 'icon-Error_x40_2xpng_2',
                className: 'toast-error'
              })
            });
      },
      changeStarredNote(note) {
        starNote('job-seeker', this.jobSeeker.id, note.id)
            .then(({data}) => {

              if (data.note.is_starred) {
                this.starredNote = data.note;
              } else {
                this.starredNote = null;
              }

              this.$toasted.show(data.message, {
                icon: 'icon-Stars_x40_2xpng_2 mr-2'
              })

              this.notes.forEach(note => {
                note.is_starred = (data.note.id === note.id) && (data.note.is_starred);
              })
            })
            .catch(error => {
              console.log('Error ', error)
            });
        ;
      }
    },

  }
</script>