<template>
  <div class="flex">
    <div class="w-1/3 pr-2">
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
                v-if="jobSeeker.gender"
                class="mr-1"
              >
                {{ jobSeeker.gender }}
              </span>
              <span
                v-if="jobSeeker.age && (jobSeeker.nationality || jobSeeker.gender) "
                class="mx-1"
              >
                •
              </span>
              <span
                v-if="jobSeeker.age"
                class="mr-1"
              >
                {{ jobSeeker.age }} years old
              </span>
            </div>
          </ListItem>

          <ListItem
            icon="icon-Location_Pin_1_1"
          >
            <span>
              Living in {{ jobSeeker.city }}

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
              Willing to work in QIZ
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
          Starred Note
        </div>
        <Notebox
          v-if="starredNote"
          :body="starredNote.body"
          :date="starredNote.date"
          :author="starredNote.author"
          :show-star="false"
          :show-creator-details="false"
          custom-class="border-none pl-0"
        />
        <EmptyState
          v-else
          icon="icon-Stars_x40_2xpng_2 text-5xl mt-3 block"
          message="You haven't starred any notes!"
          custom-class="mt-5 min-h-200 text-lg"
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
              @click="addNoteClick"
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
            <div v-if="notes && notes.length > 0">
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


            <EmptyState
              v-else
              icon="icon-Note_x40_2xpng_2 text-3xl mt-3 block"
              message="You don't have any notes!"
              custom-class="mt-5 min-h-200 text-lg"
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
  import {get as getNotes} from '../API/noteAPI'
  import {post as addNote} from '../API/noteAPI'

  export default {
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
        starredNote: null,
        notes: []
      }
    },
    created() {
      this.getNotes();
    },
    methods: {
      getNotes() {
        getNotes('job-seeker', this.jobSeeker.id)
            .then(({data}) => {
              this.notes = data.data;
            }).catch(error => {
          console.log('Error : ', error);
        });
      },
      changeJobOpeningview(view) {
        this.jobOpeningView = view;
        if (view === 'notes') {
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

        addNote('job-seeker',this.jobSeeker.id, {note: noteText})
            .then(resp => {
              this.notes.push(resp.data.note);
            }).catch(error => {
          console.log('Error : ', error);
        });


      },
      changeStarredNote(note) {
        this.starredNote = note;
      }
    },

  }
</script>